<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\View;
use App\Helpers\DataStore;

class AdminController
{
    public function __construct()
    {
        Auth::requireAuth();
    }

    // ─── DASHBOARD ──────────────────────────────────────────

    public function dashboard(array $params, array $route): void
    {
        $blogData = require ROOT_PATH . '/src/config/blog-data.php';
        $videoData = require ROOT_PATH . '/src/config/video-data.php';

        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');

        $articles = $blogData['articles'] ?? [];
        $videos = array_filter($videoData['videos'] ?? [], fn($v) => $v['is_active'] ?? true);

        $totalProducts = 0;
        foreach ($subStore->all() as $sub) {
            $totalProducts += $sub['count'] ?? 0;
        }

        $stats = [
            'categories' => $catStore->count(),
            'products'   => $totalProducts,
            'articles'   => count($articles),
            'videos'     => count($videos),
        ];

        usort($articles, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
        $recentArticles = array_slice($articles, 0, 5);

        $videoList = array_values($videos);
        usort($videoList, fn($a, $b) => strtotime($b['published_at']) - strtotime($a['published_at']));
        $recentVideos = array_slice($videoList, 0, 5);

        View::render('admin/dashboard', [
            'pageTitle'      => 'Dashboard',
            'stats'          => $stats,
            'recentArticles' => $recentArticles,
            'recentVideos'   => $recentVideos,
            'adminUser'      => Auth::user(),
        ], 'admin');
    }

    // ─── CATEGORII ──────────────────────────────────────────

    public function categories(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');

        $categories = $catStore->orderBy('sort_order');

        // Numara subcategorii per categorie
        $subcategoryCounts = [];
        foreach ($subStore->all() as $sub) {
            $catId = $sub['category_id'] ?? 0;
            $subcategoryCounts[$catId] = ($subcategoryCounts[$catId] ?? 0) + 1;
        }

        View::render('admin/categories', [
            'pageTitle'         => 'Categorii',
            'categories'        => $categories,
            'subcategoryCounts' => $subcategoryCounts,
            'flash'             => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function categoryAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('categories');
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getCategoryFormData();
            $errors = $this->validateCategory($formData, $catStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $catStore->count() + 1;
                $catStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost creata cu succes.'];
                header('Location: /admin/categorii');
                exit;
            }
        }

        View::render('admin/category-form', [
            'pageTitle' => 'Adauga categorie',
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => false,
        ], 'admin');
    }

    public function categoryEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('categories');
        $id = (int) ($params['id'] ?? 0);
        $category = $catStore->find($id);

        if (!$category) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Categoria nu a fost gasita.'];
            header('Location: /admin/categorii');
            exit;
        }

        $errors = [];
        $formData = $category;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getCategoryFormData();
            $errors = $this->validateCategory($formData, $catStore, $id);

            if (empty($errors)) {
                $catStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost actualizata.'];
                header('Location: /admin/categorii');
                exit;
            }
        }

        View::render('admin/category-form', [
            'pageTitle' => 'Editeaza: ' . ($category['name'] ?? ''),
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => true,
        ], 'admin');
    }

    public function categoryDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');
        $id = (int) ($params['id'] ?? 0);

        // Verifica daca are subcategorii
        $subCount = $subStore->countWhere('category_id', $id);
        if ($subCount > 0) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Nu se poate sterge — categoria are ' . $subCount . ' subcategorii asociate.'];
            header('Location: /admin/categorii');
            exit;
        }

        $catStore->delete($id);
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost stearsa.'];
        header('Location: /admin/categorii');
        exit;
    }

    public function categoryReorder(array $params, array $route): void
    {
        Auth::requireRole('editor');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        Auth::requireCsrf();

        $order = json_decode($_POST['order'] ?? '{}', true);
        if (!empty($order)) {
            $catStore = new DataStore('categories');
            $catStore->reorder($order);
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    }

    // ─── SUBCATEGORII ───────────────────────────────────────

    public function subcategories(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');

        $filterCategory = (int) ($_GET['categorie'] ?? 0);

        if ($filterCategory) {
            $subcategories = $subStore->where('category_id', $filterCategory);
            usort($subcategories, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));
        } else {
            $subcategories = $subStore->orderBy('sort_order');
        }

        // Map category names
        $categoryNames = [];
        foreach ($catStore->all() as $cat) {
            $categoryNames[$cat['id']] = $cat['name'];
        }

        View::render('admin/subcategories', [
            'pageTitle'      => 'Subcategorii',
            'subcategories'  => $subcategories,
            'categories'     => $catStore->orderBy('sort_order'),
            'categoryNames'  => $categoryNames,
            'filterCategory' => $filterCategory,
            'flash'          => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function subcategoryAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');
        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getSubcategoryFormData();
            $errors = $this->validateSubcategory($formData, $subStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $subStore->countWhere('category_id', $formData['category_id']) + 1;
                $subStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Subcategoria a fost creata cu succes.'];
                header('Location: /admin/subcategorii');
                exit;
            }
        }

        View::render('admin/subcategory-form', [
            'pageTitle'  => 'Adauga subcategorie',
            'formData'   => $formData,
            'errors'     => $errors,
            'categories' => $catStore->orderBy('sort_order'),
            'isEdit'     => false,
        ], 'admin');
    }

    public function subcategoryEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');
        $id = (int) ($params['id'] ?? 0);
        $subcategory = $subStore->find($id);

        if (!$subcategory) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Subcategoria nu a fost gasita.'];
            header('Location: /admin/subcategorii');
            exit;
        }

        $errors = [];
        $formData = $subcategory;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getSubcategoryFormData();
            $errors = $this->validateSubcategory($formData, $subStore, $id);

            if (empty($errors)) {
                $subStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Subcategoria a fost actualizata.'];
                header('Location: /admin/subcategorii');
                exit;
            }
        }

        View::render('admin/subcategory-form', [
            'pageTitle'  => 'Editeaza: ' . ($subcategory['name'] ?? ''),
            'formData'   => $formData,
            'errors'     => $errors,
            'categories' => $catStore->orderBy('sort_order'),
            'isEdit'     => true,
        ], 'admin');
    }

    public function subcategoryDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $subStore = new DataStore('subcategories');
        $id = (int) ($params['id'] ?? 0);
        $sub = $subStore->find($id);

        if ($sub && ($sub['count'] ?? 0) > 0) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Nu se poate sterge — subcategoria are produse asociate.'];
            header('Location: /admin/subcategorii');
            exit;
        }

        $subStore->delete($id);
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Subcategoria a fost stearsa.'];
        header('Location: /admin/subcategorii');
        exit;
    }

    public function subcategoryReorder(array $params, array $route): void
    {
        Auth::requireRole('editor');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        Auth::requireCsrf();

        $order = json_decode($_POST['order'] ?? '{}', true);
        if (!empty($order)) {
            $subStore = new DataStore('subcategories');
            $subStore->reorder($order);
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    }

    // ─── PLACEHOLDER PAGES ──────────────────────────────────

    public function products(array $params, array $route): void
    {
        Auth::requireRole('editor');
        View::render('admin/products', ['pageTitle' => 'Produse'], 'admin');
    }

    public function blog(array $params, array $route): void
    {
        Auth::requireRole('editor');
        View::render('admin/blog', ['pageTitle' => 'Blog - Articole'], 'admin');
    }

    public function videos(array $params, array $route): void
    {
        Auth::requireRole('editor');
        View::render('admin/videos', ['pageTitle' => 'Videouri TikTok'], 'admin');
    }

    public function media(array $params, array $route): void
    {
        Auth::requireRole('editor');
        View::render('admin/media', ['pageTitle' => 'Media'], 'admin');
    }

    public function seo(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        View::render('admin/seo', ['pageTitle' => 'SEO'], 'admin');
    }

    public function homepage(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        View::render('admin/homepage', ['pageTitle' => 'Homepage'], 'admin');
    }

    public function messages(array $params, array $route): void
    {
        View::render('admin/messages', ['pageTitle' => 'Mesaje / Lead-uri'], 'admin');
    }

    public function users(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        View::render('admin/users', ['pageTitle' => 'Utilizatori'], 'admin');
    }

    public function settings(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        View::render('admin/settings', ['pageTitle' => 'Setari'], 'admin');
    }

    // ─── HELPERS ────────────────────────────────────────────

    private function getCategoryFormData(): array
    {
        return [
            'name'            => trim($_POST['name'] ?? ''),
            'slug'            => trim($_POST['slug'] ?? ''),
            'description'     => trim($_POST['description'] ?? ''),
            'icon'            => trim($_POST['icon'] ?? ''),
            'image'           => trim($_POST['image'] ?? ''),
            'seo_title'       => trim($_POST['seo_title'] ?? ''),
            'seo_description' => trim($_POST['seo_description'] ?? ''),
            'seo_text'        => $_POST['seo_text'] ?? '',
            'sort_order'      => (int) ($_POST['sort_order'] ?? 0),
            'is_active'       => !empty($_POST['is_active']),
        ];
    }

    private function getSubcategoryFormData(): array
    {
        return [
            'category_id'    => (int) ($_POST['category_id'] ?? 0),
            'name'           => trim($_POST['name'] ?? ''),
            'slug'           => trim($_POST['slug'] ?? ''),
            'description'    => trim($_POST['description'] ?? ''),
            'icon'           => trim($_POST['icon'] ?? ''),
            'image'          => trim($_POST['image'] ?? ''),
            'seo_title'      => trim($_POST['seo_title'] ?? ''),
            'seo_description'=> trim($_POST['seo_description'] ?? ''),
            'seo_text'       => $_POST['seo_text'] ?? '',
            'sort_order'     => (int) ($_POST['sort_order'] ?? 0),
            'is_active'      => !empty($_POST['is_active']),
            'count'          => (int) ($_POST['count'] ?? 0),
        ];
    }

    private function validateCategory(array $data, DataStore $store, ?int $excludeId = null): array
    {
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Numele categoriei este obligatoriu.';
        }
        if (empty($data['slug'])) {
            $errors[] = 'Slug-ul este obligatoriu.';
        } elseif (!preg_match('/^[a-z0-9\-]+$/', $data['slug'])) {
            $errors[] = 'Slug-ul poate contine doar litere mici, cifre si cratime.';
        } elseif ($store->slugExists($data['slug'], $excludeId)) {
            $errors[] = 'Acest slug exista deja.';
        }
        return $errors;
    }

    private function validateSubcategory(array $data, DataStore $store, ?int $excludeId = null): array
    {
        $errors = [];
        if (empty($data['category_id'])) {
            $errors[] = 'Selectati categoria parinte.';
        }
        if (empty($data['name'])) {
            $errors[] = 'Numele subcategoriei este obligatoriu.';
        }
        if (empty($data['slug'])) {
            $errors[] = 'Slug-ul este obligatoriu.';
        } elseif (!preg_match('/^[a-z0-9\-]+$/', $data['slug'])) {
            $errors[] = 'Slug-ul poate contine doar litere mici, cifre si cratime.';
        }
        return $errors;
    }
}
