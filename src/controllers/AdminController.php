<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\View;
use App\Helpers\DataStore;
use App\Helpers\MediaHelper;

class AdminController
{
    public function __construct()
    {
        Auth::requireAuth();
    }

    // ─── DASHBOARD ──────────────────────────────────────────

    public function dashboard(array $params, array $route): void
    {
        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');
        $blogStore = new DataStore('blog-articles');
        $videoStore = new DataStore('videos');

        $articles = $blogStore->all();
        $videos = array_filter($videoStore->all(), fn($v) => !empty($v['is_active']));

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

    // ─── PRODUSE ────────────────────────────────────────────

    public function products(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $prodStore = new DataStore('products');
        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');

        $allProducts = $prodStore->all();

        // Filters
        $filterCategory = (int) ($_GET['categorie'] ?? 0);
        $filterSubcategory = (int) ($_GET['subcategorie'] ?? 0);
        $filterStatus = $_GET['status'] ?? '';
        $filterManufacturer = $_GET['producator'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($filterCategory) {
            $allProducts = array_filter($allProducts, fn($p) => ($p['category_id'] ?? 0) === $filterCategory);
        }
        if ($filterSubcategory) {
            $allProducts = array_filter($allProducts, fn($p) => ($p['subcategory_id'] ?? 0) === $filterSubcategory);
        }
        if ($filterStatus) {
            $allProducts = array_filter($allProducts, fn($p) => ($p['status'] ?? 'activ') === $filterStatus);
        }
        if ($filterManufacturer) {
            $allProducts = array_filter($allProducts, fn($p) => ($p['manufacturer'] ?? '') === $filterManufacturer);
        }
        if ($search) {
            $q = mb_strtolower($search);
            $allProducts = array_filter($allProducts, fn($p) =>
                str_contains(mb_strtolower($p['name'] ?? ''), $q) ||
                str_contains(mb_strtolower($p['slug'] ?? ''), $q) ||
                str_contains(mb_strtolower($p['manufacturer'] ?? ''), $q)
            );
        }

        $allProducts = array_values($allProducts);
        usort($allProducts, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

        // Pagination
        $perPage = 20;
        $page = max(1, (int) ($_GET['pagina'] ?? 1));
        $total = count($allProducts);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $perPage;
        $products = array_slice($allProducts, $offset, $perPage);

        // Maps for display
        $categoryNames = [];
        foreach ($catStore->all() as $cat) {
            $categoryNames[$cat['id']] = $cat['name'];
        }
        $subcategoryNames = [];
        foreach ($subStore->all() as $sub) {
            $subcategoryNames[$sub['id']] = $sub['name'];
        }

        // Get unique manufacturers
        $manufacturers = array_unique(array_filter(array_column($prodStore->all(), 'manufacturer')));
        sort($manufacturers);

        View::render('admin/products', [
            'pageTitle'          => 'Produse',
            'products'           => $products,
            'categories'         => $catStore->orderBy('sort_order'),
            'subcategories'      => $subStore->orderBy('sort_order'),
            'categoryNames'      => $categoryNames,
            'subcategoryNames'   => $subcategoryNames,
            'manufacturers'      => $manufacturers,
            'filterCategory'     => $filterCategory,
            'filterSubcategory'  => $filterSubcategory,
            'filterStatus'       => $filterStatus,
            'filterManufacturer' => $filterManufacturer,
            'search'             => $search,
            'page'               => $page,
            'totalPages'         => $totalPages,
            'total'              => $total,
            'flash'              => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function productAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $prodStore = new DataStore('products');
        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');
        $errors = [];
        $formData = $this->getProductDefaults();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getProductFormData();
            $errors = $this->validateProduct($formData, $prodStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $prodStore->count() + 1;
                $prodStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Produsul a fost creat cu succes.'];
                header('Location: /admin/produse');
                exit;
            }
        }

        View::render('admin/product-form', [
            'pageTitle'     => 'Adauga produs',
            'formData'      => $formData,
            'errors'        => $errors,
            'categories'    => $catStore->orderBy('sort_order'),
            'subcategories' => $subStore->orderBy('sort_order'),
            'allProducts'   => $prodStore->all(),
            'isEdit'        => false,
        ], 'admin');
    }

    public function productEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $prodStore = new DataStore('products');
        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');
        $id = (int) ($params['id'] ?? 0);
        $product = $prodStore->find($id);

        if (!$product) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Produsul nu a fost gasit.'];
            header('Location: /admin/produse');
            exit;
        }

        $errors = [];
        $formData = $product;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getProductFormData();
            $errors = $this->validateProduct($formData, $prodStore, $id);

            if (empty($errors)) {
                $prodStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Produsul a fost actualizat.'];
                header('Location: /admin/produse');
                exit;
            }
        }

        View::render('admin/product-form', [
            'pageTitle'     => 'Editeaza: ' . ($product['name'] ?? ''),
            'formData'      => $formData,
            'errors'        => $errors,
            'categories'    => $catStore->orderBy('sort_order'),
            'subcategories' => $subStore->orderBy('sort_order'),
            'allProducts'   => $prodStore->all(),
            'isEdit'        => true,
        ], 'admin');
    }

    public function productDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $prodStore = new DataStore('products');
        $id = (int) ($params['id'] ?? 0);

        $prodStore->delete($id);
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Produsul a fost sters.'];
        header('Location: /admin/produse');
        exit;
    }

    public function productDuplicate(array $params, array $route): void
    {
        Auth::requireRole('editor');
        Auth::requireCsrf();

        $prodStore = new DataStore('products');
        $id = (int) ($params['id'] ?? 0);
        $product = $prodStore->find($id);

        if (!$product) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Produsul nu a fost gasit.'];
            header('Location: /admin/produse');
            exit;
        }

        unset($product['id'], $product['created_at'], $product['updated_at']);
        $product['name'] = $product['name'] . ' (copie)';
        $product['slug'] = $product['slug'] . '-copie-' . time();
        $product['status'] = 'draft';
        $product['sort_order'] = $prodStore->count() + 1;

        $newProduct = $prodStore->create($product);
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Produsul a fost duplicat. Editeaza copia.'];
        header('Location: /admin/produse/editeaza/' . $newProduct['id']);
        exit;
    }

    // ─── BLOG ────────────────────────────────────────────

    public function blog(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $artStore = new DataStore('blog-articles');
        $catStore = new DataStore('blog-categories');

        $allArticles = $artStore->all();

        // Filters
        $filterCategory = (int) ($_GET['categorie'] ?? 0);
        $filterStatus = $_GET['status'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($filterCategory) {
            $allArticles = array_filter($allArticles, fn($a) => ($a['category_id'] ?? 0) === $filterCategory);
        }
        if ($filterStatus) {
            $allArticles = array_filter($allArticles, fn($a) => ($a['status'] ?? 'draft') === $filterStatus);
        }
        if ($search) {
            $q = mb_strtolower($search);
            $allArticles = array_filter($allArticles, fn($a) =>
                str_contains(mb_strtolower($a['title'] ?? ''), $q) ||
                str_contains(mb_strtolower($a['slug'] ?? ''), $q) ||
                str_contains(mb_strtolower($a['author'] ?? ''), $q)
            );
        }

        $allArticles = array_values($allArticles);
        usort($allArticles, fn($a, $b) => strtotime($b['date'] ?? '2000-01-01') - strtotime($a['date'] ?? '2000-01-01'));

        // Pagination
        $perPage = 20;
        $page = max(1, (int) ($_GET['pagina'] ?? 1));
        $total = count($allArticles);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $perPage;
        $articles = array_slice($allArticles, $offset, $perPage);

        // Category names map
        $categoryNames = [];
        foreach ($catStore->all() as $cat) {
            $categoryNames[$cat['id']] = $cat['name'];
        }

        View::render('admin/blog', [
            'pageTitle'      => 'Blog - Articole',
            'articles'       => $articles,
            'categories'     => $catStore->orderBy('sort_order'),
            'categoryNames'  => $categoryNames,
            'filterCategory' => $filterCategory,
            'filterStatus'   => $filterStatus,
            'search'         => $search,
            'page'           => $page,
            'totalPages'     => $totalPages,
            'total'          => $total,
            'flash'          => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function blogAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $artStore = new DataStore('blog-articles');
        $catStore = new DataStore('blog-categories');
        $errors = [];
        $formData = $this->getBlogDefaults();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getBlogFormData();
            $errors = $this->validateBlogArticle($formData, $artStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $artStore->count() + 1;
                $artStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Articolul a fost creat cu succes.'];
                header('Location: /admin/blog');
                exit;
            }
        }

        View::render('admin/blog-form', [
            'pageTitle'  => 'Adauga articol',
            'formData'   => $formData,
            'errors'     => $errors,
            'categories' => $catStore->orderBy('sort_order'),
            'isEdit'     => false,
        ], 'admin');
    }

    public function blogEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $artStore = new DataStore('blog-articles');
        $catStore = new DataStore('blog-categories');
        $id = (int) ($params['id'] ?? 0);
        $article = $artStore->find($id);

        if (!$article) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Articolul nu a fost gasit.'];
            header('Location: /admin/blog');
            exit;
        }

        $errors = [];
        $formData = $article;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getBlogFormData();
            $errors = $this->validateBlogArticle($formData, $artStore, $id);

            if (empty($errors)) {
                $artStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Articolul a fost actualizat.'];
                header('Location: /admin/blog');
                exit;
            }
        }

        View::render('admin/blog-form', [
            'pageTitle'  => 'Editeaza: ' . ($article['title'] ?? ''),
            'formData'   => $formData,
            'errors'     => $errors,
            'categories' => $catStore->orderBy('sort_order'),
            'isEdit'     => true,
        ], 'admin');
    }

    public function blogDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $artStore = new DataStore('blog-articles');
        $artStore->delete((int) ($params['id'] ?? 0));
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Articolul a fost sters.'];
        header('Location: /admin/blog');
        exit;
    }

    // ─── BLOG CATEGORIES ────────────────────────────────────

    public function blogCategories(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('blog-categories');

        View::render('admin/blog-categories', [
            'pageTitle'  => 'Categorii Blog',
            'categories' => $catStore->orderBy('sort_order'),
            'flash'      => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function blogCategoryAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('blog-categories');
        $errors = [];
        $formData = ['name' => '', 'slug' => '', 'description' => '', 'icon' => '', 'sort_order' => 0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getBlogCategoryFormData();
            $errors = $this->validateBlogCategory($formData, $catStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $catStore->count() + 1;
                $catStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost creata.'];
                header('Location: /admin/blog/categorii');
                exit;
            }
        }

        View::render('admin/blog-category-form', [
            'pageTitle' => 'Adauga categorie blog',
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => false,
        ], 'admin');
    }

    public function blogCategoryEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('blog-categories');
        $id = (int) ($params['id'] ?? 0);
        $category = $catStore->find($id);

        if (!$category) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Categoria nu a fost gasita.'];
            header('Location: /admin/blog/categorii');
            exit;
        }

        $errors = [];
        $formData = $category;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getBlogCategoryFormData();
            $errors = $this->validateBlogCategory($formData, $catStore, $id);

            if (empty($errors)) {
                $catStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost actualizata.'];
                header('Location: /admin/blog/categorii');
                exit;
            }
        }

        View::render('admin/blog-category-form', [
            'pageTitle' => 'Editeaza: ' . ($category['name'] ?? ''),
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => true,
        ], 'admin');
    }

    public function blogCategoryDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $catStore = new DataStore('blog-categories');
        $catStore->delete((int) ($params['id'] ?? 0));
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost stearsa.'];
        header('Location: /admin/blog/categorii');
        exit;
    }

    // ─── VIDEOURI TIKTOK ────────────────────────────────────

    public function videos(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $vidStore = new DataStore('videos');
        $catStore = new DataStore('video-categories');

        $allVideos = $vidStore->all();

        // Filters
        $filterCategory = (int) ($_GET['categorie'] ?? 0);
        $filterStatus = $_GET['status'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($filterCategory) {
            // Include subcategories of selected parent
            $subIds = array_column(array_filter($catStore->all(), fn($c) => ($c['parent_id'] ?? 0) === $filterCategory), 'id');
            $allIds = array_merge([$filterCategory], $subIds);
            $allVideos = array_filter($allVideos, fn($v) =>
                in_array($v['category_id'] ?? 0, $allIds) || in_array($v['subcategory_id'] ?? 0, $allIds)
            );
        }
        if ($filterStatus === 'activ') {
            $allVideos = array_filter($allVideos, fn($v) => !empty($v['is_active']));
        } elseif ($filterStatus === 'inactiv') {
            $allVideos = array_filter($allVideos, fn($v) => empty($v['is_active']));
        }
        if ($search) {
            $q = mb_strtolower($search);
            $allVideos = array_filter($allVideos, fn($v) =>
                str_contains(mb_strtolower($v['title'] ?? ''), $q) ||
                str_contains(mb_strtolower($v['slug'] ?? ''), $q)
            );
        }

        $allVideos = array_values($allVideos);
        usort($allVideos, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

        // Pagination
        $perPage = 20;
        $page = max(1, (int) ($_GET['pagina'] ?? 1));
        $total = count($allVideos);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $perPage;
        $videos = array_slice($allVideos, $offset, $perPage);

        // Category names map
        $categoryNames = [];
        foreach ($catStore->all() as $cat) {
            $categoryNames[$cat['id']] = $cat['name'];
        }

        // Parent categories for filter
        $parentCategories = array_filter($catStore->all(), fn($c) => ($c['parent_id'] ?? 0) === 0);
        usort($parentCategories, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

        View::render('admin/videos', [
            'pageTitle'        => 'Videouri TikTok',
            'videos'           => $videos,
            'categories'       => $parentCategories,
            'categoryNames'    => $categoryNames,
            'filterCategory'   => $filterCategory,
            'filterStatus'     => $filterStatus,
            'search'           => $search,
            'page'             => $page,
            'totalPages'       => $totalPages,
            'total'            => $total,
            'flash'            => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function videoAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $vidStore = new DataStore('videos');
        $catStore = new DataStore('video-categories');
        $errors = [];
        $formData = $this->getVideoDefaults();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getVideoFormData();
            $errors = $this->validateVideo($formData, $vidStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $vidStore->count() + 1;
                $vidStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Videoul a fost creat cu succes.'];
                header('Location: /admin/videouri');
                exit;
            }
        }

        View::render('admin/video-form', [
            'pageTitle'     => 'Adauga video',
            'formData'      => $formData,
            'errors'        => $errors,
            'allCategories' => $catStore->orderBy('sort_order'),
            'isEdit'        => false,
        ], 'admin');
    }

    public function videoEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $vidStore = new DataStore('videos');
        $catStore = new DataStore('video-categories');
        $id = (int) ($params['id'] ?? 0);
        $video = $vidStore->find($id);

        if (!$video) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Videoul nu a fost gasit.'];
            header('Location: /admin/videouri');
            exit;
        }

        $errors = [];
        $formData = $video;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getVideoFormData();
            $errors = $this->validateVideo($formData, $vidStore, $id);

            if (empty($errors)) {
                $vidStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Videoul a fost actualizat.'];
                header('Location: /admin/videouri');
                exit;
            }
        }

        View::render('admin/video-form', [
            'pageTitle'     => 'Editeaza: ' . ($video['title'] ?? ''),
            'formData'      => $formData,
            'errors'        => $errors,
            'allCategories' => $catStore->orderBy('sort_order'),
            'isEdit'        => true,
        ], 'admin');
    }

    public function videoDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $vidStore = new DataStore('videos');
        $vidStore->delete((int) ($params['id'] ?? 0));
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Videoul a fost sters.'];
        header('Location: /admin/videouri');
        exit;
    }

    // ─── VIDEO CATEGORIES ────────────────────────────────────

    public function videoCategories(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('video-categories');
        $vidStore = new DataStore('videos');
        $allCats = $catStore->orderBy('sort_order');

        // Count videos per category
        $allVideos = $vidStore->all();
        foreach ($allCats as &$cat) {
            $cid = $cat['id'];
            $cat['video_count'] = count(array_filter($allVideos, fn($v) =>
                ($v['category_id'] ?? 0) === $cid || ($v['subcategory_id'] ?? 0) === $cid
            ));
        }
        unset($cat);

        // Sort hierarchically: parent then its children
        $parents = array_filter($allCats, fn($c) => ($c['parent_id'] ?? 0) === 0);
        $children = array_filter($allCats, fn($c) => ($c['parent_id'] ?? 0) > 0);
        $sorted = [];
        foreach ($parents as $p) {
            $sorted[] = $p;
            foreach ($children as $ch) {
                if (($ch['parent_id'] ?? 0) === $p['id']) {
                    $sorted[] = $ch;
                }
            }
        }

        View::render('admin/video-categories', [
            'pageTitle'  => 'Categorii Video',
            'categories' => $sorted,
            'flash'      => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function videoCategoryAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('video-categories');
        $errors = [];
        $formData = ['name' => '', 'slug' => '', 'parent_id' => 0, 'icon' => '', 'sort_order' => 0, 'is_active' => true];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getVideoCategoryFormData();
            $errors = $this->validateVideoCategory($formData, $catStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $catStore->count() + 1;
                $catStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost creata.'];
                header('Location: /admin/videouri/categorii');
                exit;
            }
        }

        $parentCategories = array_filter($catStore->all(), fn($c) => ($c['parent_id'] ?? 0) === 0);

        View::render('admin/video-category-form', [
            'pageTitle'        => 'Adauga categorie video',
            'formData'         => $formData,
            'errors'           => $errors,
            'parentCategories' => $parentCategories,
            'isEdit'           => false,
        ], 'admin');
    }

    public function videoCategoryEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $catStore = new DataStore('video-categories');
        $id = (int) ($params['id'] ?? 0);
        $category = $catStore->find($id);

        if (!$category) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Categoria nu a fost gasita.'];
            header('Location: /admin/videouri/categorii');
            exit;
        }

        $errors = [];
        $formData = $category;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getVideoCategoryFormData();
            $errors = $this->validateVideoCategory($formData, $catStore, $id);

            if (empty($errors)) {
                $catStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost actualizata.'];
                header('Location: /admin/videouri/categorii');
                exit;
            }
        }

        $parentCategories = array_filter($catStore->all(), fn($c) => ($c['parent_id'] ?? 0) === 0 && $c['id'] !== $id);

        View::render('admin/video-category-form', [
            'pageTitle'        => 'Editeaza: ' . ($category['name'] ?? ''),
            'formData'         => $formData,
            'errors'           => $errors,
            'parentCategories' => $parentCategories,
            'isEdit'           => true,
        ], 'admin');
    }

    public function videoCategoryDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $catStore = new DataStore('video-categories');
        $vidStore = new DataStore('videos');
        $id = (int) ($params['id'] ?? 0);

        // Check for children
        $children = array_filter($catStore->all(), fn($c) => ($c['parent_id'] ?? 0) === $id);
        if (!empty($children)) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Nu poti sterge o categorie cu subcategorii. Sterge mai intai subcategoriile.'];
            header('Location: /admin/videouri/categorii');
            exit;
        }

        // Check for videos
        $hasVideos = array_filter($vidStore->all(), fn($v) =>
            ($v['category_id'] ?? 0) === $id || ($v['subcategory_id'] ?? 0) === $id
        );
        if (!empty($hasVideos)) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Nu poti sterge o categorie cu videouri asociate.'];
            header('Location: /admin/videouri/categorii');
            exit;
        }

        $catStore->delete($id);
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Categoria a fost stearsa.'];
        header('Location: /admin/videouri/categorii');
        exit;
    }

    public function media(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $mediaStore = new DataStore('media');
        $allMedia = $mediaStore->orderBy('id', 'desc');

        // Filters
        $filterZone = $_GET['zona'] ?? '';
        $filterType = $_GET['tip'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($filterZone) {
            $allMedia = array_filter($allMedia, fn($m) => ($m['zone'] ?? '') === $filterZone);
        }
        if ($filterType === 'imagine') {
            $allMedia = array_filter($allMedia, fn($m) => str_starts_with($m['mime'] ?? '', 'image/'));
        }
        if ($search) {
            $q = mb_strtolower($search);
            $allMedia = array_filter($allMedia, fn($m) =>
                str_contains(mb_strtolower($m['original_name'] ?? ''), $q) ||
                str_contains(mb_strtolower($m['filename'] ?? ''), $q) ||
                str_contains(mb_strtolower($m['alt'] ?? ''), $q)
            );
        }

        $allMedia = array_values($allMedia);

        View::render('admin/media', [
            'pageTitle'  => 'Media',
            'media'      => $allMedia,
            'total'      => count($allMedia),
            'zones'      => MediaHelper::ZONES,
            'filterZone' => $filterZone,
            'filterType' => $filterType,
            'search'     => $search,
            'flash'      => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function mediaUpload(array $params, array $route): void
    {
        Auth::requireRole('editor');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        Auth::requireCsrf();

        $zone = $_POST['zone'] ?? 'general';
        $alt = trim($_POST['alt'] ?? '');
        $files = $_FILES['media_files'] ?? null;

        if (!$files || empty($files['name'][0])) {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Niciun fisier selectat.']);
                exit;
            }
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Niciun fisier selectat.'];
            header('Location: /admin/media');
            exit;
        }

        $mediaStore = new DataStore('media');
        $uploaded = [];
        $errors = [];

        // Normalize files array for multiple uploads
        $fileCount = count($files['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            $file = [
                'name'     => $files['name'][$i],
                'type'     => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error'    => $files['error'][$i],
                'size'     => $files['size'][$i],
            ];

            $result = MediaHelper::processUpload($file, $zone);
            if ($result) {
                $mediaItem = $mediaStore->create([
                    'filename'      => $result['filename'],
                    'original_name' => $result['original_name'],
                    'url'           => $result['url'],
                    'thumb_url'     => $result['thumb_url'],
                    'png_fallback'  => $result['png_fallback'],
                    'mime'          => $result['mime'],
                    'size'          => $result['size'],
                    'width'         => $result['width'],
                    'height'        => $result['height'],
                    'zone'          => $result['zone'],
                    'alt'           => $alt,
                    'sort_order'    => 0,
                ]);
                $uploaded[] = $mediaItem;
            } else {
                $errors[] = $files['name'][$i];
            }
        }

        // AJAX response
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'success'  => !empty($uploaded),
                'uploaded' => $uploaded,
                'errors'   => $errors,
            ]);
            exit;
        }

        // Regular form response
        $msg = count($uploaded) . ' fisier(e) uploadate cu succes.';
        if (!empty($errors)) {
            $msg .= ' ' . count($errors) . ' erori: ' . implode(', ', $errors);
        }
        $_SESSION['_flash'] = ['type' => empty($errors) ? 'success' : 'error', 'message' => $msg];
        header('Location: /admin/media');
        exit;
    }

    public function mediaDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $mediaStore = new DataStore('media');
        $id = (int) ($params['id'] ?? 0);
        $media = $mediaStore->find($id);

        if ($media) {
            MediaHelper::deleteFiles($media);
            $mediaStore->delete($id);
            $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Fisierul a fost sters.'];
        }

        // AJAX response
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }

        header('Location: /admin/media');
        exit;
    }

    public function seo(array $params, array $route): void
    {
        Auth::requireRole('administrator');

        $settings = \App\Helpers\SeoHelper::settings();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $action = $_POST['action'] ?? '';

            if ($action === 'save_settings') {
                $settings['site_title'] = trim($_POST['site_title'] ?? '');
                $settings['title_separator'] = $_POST['title_separator'] ?? ' | ';
                $settings['default_description'] = trim($_POST['default_description'] ?? '');
                $settings['robots_txt'] = $_POST['robots_txt'] ?? '';
                $settings['analytics_code'] = trim($_POST['analytics_code'] ?? '');
                $settings['tag_manager_id'] = trim($_POST['tag_manager_id'] ?? '');
                \App\Helpers\SeoHelper::saveSettings($settings);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Setarile SEO au fost salvate.'];
            } elseif ($action === 'save_redirects') {
                $fromArr = $_POST['redirect_from'] ?? [];
                $toArr = $_POST['redirect_to'] ?? [];
                $activeArr = $_POST['redirect_active'] ?? [];
                $redirects = [];
                foreach ($fromArr as $i => $from) {
                    $from = trim($from);
                    $to = trim($toArr[$i] ?? '');
                    if ($from === '' && $to === '') continue;
                    $redirects[] = [
                        'from' => $from,
                        'to' => $to,
                        'active' => isset($activeArr[$i]),
                    ];
                }
                $settings['redirects'] = $redirects;
                \App\Helpers\SeoHelper::saveSettings($settings);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => count($redirects) . ' redirecturi salvate.'];
            }

            header('Location: /admin/seo');
            exit;
        }

        // Sitemap stats
        $catStore = new DataStore('categories');
        $prodStore = new DataStore('products');
        $blogStore = new DataStore('blog-articles');
        $sitemapStats = [
            'Pagini statice' => 6,
            'Categorii' => $catStore->count(),
            'Produse active' => count(array_filter($prodStore->all(), fn($p) => ($p['status'] ?? 'draft') === 'activ')),
            'Articole blog' => $blogStore->count(),
            'Redirecturi 301' => count($settings['redirects'] ?? []),
        ];

        View::render('admin/seo', [
            'pageTitle'    => 'SEO',
            'settings'     => $settings,
            'sitemapStats' => $sitemapStats,
            'flash'        => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function homepage(array $params, array $route): void
    {
        Auth::requireRole('administrator');

        $hp = $this->loadHomepage();
        $productStore = new DataStore('products');
        $allProducts = $productStore->orderBy('sort_order');

        View::render('admin/homepage', [
            'pageTitle'   => 'Homepage',
            'homepage'    => $hp,
            'allProducts' => $allProducts,
            'flash'       => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function homepageSave(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $section = $params['section'] ?? '';
        $hp = $this->loadHomepage();

        switch ($section) {
            case 'hero':
                $hp['hero']['slides'] = $this->parseRepeaterItems($_POST['slides'] ?? [], [
                    'title', 'subtitle', 'image', 'button_text', 'button_link',
                    'button2_text', 'button2_link', 'badge_icon', 'badge_text',
                ]);
                break;

            case 'categorii':
                $hp['categories']['title'] = trim($_POST['title'] ?? '');
                $hp['categories']['subtitle'] = trim($_POST['subtitle'] ?? '');
                $hp['categories']['items'] = $this->parseRepeaterItems($_POST['items'] ?? [], [
                    'name', 'description', 'icon', 'link',
                ]);
                break;

            case 'branduri':
                $hp['brands']['title'] = trim($_POST['title'] ?? '');
                $hp['brands']['subtitle'] = trim($_POST['subtitle'] ?? '');
                $hp['brands']['items'] = $this->parseRepeaterItems($_POST['items'] ?? [], [
                    'name', 'link',
                ]);
                break;

            case 'produse':
                $hp['products']['title'] = trim($_POST['title'] ?? '');
                $hp['products']['subtitle'] = trim($_POST['subtitle'] ?? '');
                $hp['products']['mode'] = $_POST['mode'] ?? 'manual';
                $hp['products']['auto_count'] = (int)($_POST['auto_count'] ?? 4);
                $slugs = array_filter(array_map('trim', $_POST['manual_slugs'] ?? []));
                $hp['products']['manual_slugs'] = array_values($slugs);
                break;

            case 'bannere':
                $hp['banners']['items'] = $this->parseRepeaterItems($_POST['items'] ?? [], [
                    'title', 'text', 'image', 'link', 'position',
                ]);
                break;

            case 'despre':
                $hp['about']['title'] = trim($_POST['title'] ?? '');
                $hp['about']['text'] = trim($_POST['text'] ?? '');
                $hp['about']['image'] = trim($_POST['image'] ?? '');
                $hp['about']['features'] = $this->parseRepeaterItems($_POST['features'] ?? [], [
                    'icon', 'title', 'text',
                ]);
                break;

            case 'servicii':
                $hp['services']['title'] = trim($_POST['title'] ?? '');
                $hp['services']['subtitle'] = trim($_POST['subtitle'] ?? '');
                $hp['services']['cta_text'] = trim($_POST['cta_text'] ?? '');
                $hp['services']['cta_link'] = trim($_POST['cta_link'] ?? '');
                $hp['services']['items'] = $this->parseRepeaterItems($_POST['items'] ?? [], [
                    'icon', 'title', 'text',
                ]);
                break;

            case 'blog':
                $hp['blog']['title'] = trim($_POST['title'] ?? '');
                $hp['blog']['subtitle'] = trim($_POST['subtitle'] ?? '');
                $hp['blog']['count'] = max(1, min(6, (int)($_POST['count'] ?? 3)));
                break;

            case 'cta':
                $hp['cta']['title'] = trim($_POST['title'] ?? '');
                $hp['cta']['text'] = trim($_POST['text'] ?? '');
                $hp['cta']['button_text'] = trim($_POST['button_text'] ?? '');
                $hp['cta']['button_link'] = trim($_POST['button_link'] ?? '');
                $hp['cta']['phone'] = trim($_POST['phone'] ?? '');
                break;

            case 'ordine':
                $order = $_POST['sections_order'] ?? [];
                $valid = ['hero', 'categories', 'brands', 'products', 'banners', 'about', 'services', 'blog', 'cta'];
                $hp['sections_order'] = array_values(array_intersect($order, $valid));
                break;

            default:
                $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Sectiune necunoscuta.'];
                header('Location: /admin/homepage');
                return;
        }

        $this->saveHomepage($hp);

        $sectionNames = [
            'hero' => 'Slider/Hero', 'categorii' => 'Categorii', 'branduri' => 'Branduri',
            'produse' => 'Produse', 'bannere' => 'Bannere', 'despre' => 'Despre noi',
            'servicii' => 'Servicii', 'blog' => 'Blog', 'cta' => 'CTA', 'ordine' => 'Ordine sectiuni',
        ];
        $_SESSION['_flash'] = [
            'type' => 'success',
            'message' => 'Sectiunea "' . ($sectionNames[$section] ?? $section) . '" a fost salvata.',
        ];
        header('Location: /admin/homepage');
    }

    // ─── EVENIMENTE ─────────────────────────────────────────

    public function events(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $evStore = new DataStore('events');
        $allEvents = $evStore->all();

        // Filters
        $filterStatus = $_GET['status'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($filterStatus) {
            $allEvents = array_filter($allEvents, fn($e) => ($e['status'] ?? 'draft') === $filterStatus);
        }
        if ($search) {
            $q = mb_strtolower($search);
            $allEvents = array_filter($allEvents, fn($e) =>
                str_contains(mb_strtolower($e['title'] ?? ''), $q) ||
                str_contains(mb_strtolower($e['slug'] ?? ''), $q) ||
                str_contains(mb_strtolower($e['location'] ?? ''), $q)
            );
        }

        $allEvents = array_values($allEvents);
        usort($allEvents, fn($a, $b) => strtotime($b['event_date'] ?? '2000-01-01') - strtotime($a['event_date'] ?? '2000-01-01'));

        // Pagination
        $perPage = 20;
        $page = max(1, (int) ($_GET['pagina'] ?? 1));
        $total = count($allEvents);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page = min($page, $totalPages);
        $offset = ($page - 1) * $perPage;
        $events = array_slice($allEvents, $offset, $perPage);

        View::render('admin/events', [
            'pageTitle'    => 'Evenimente',
            'events'       => $events,
            'filterStatus' => $filterStatus,
            'search'       => $search,
            'page'         => $page,
            'totalPages'   => $totalPages,
            'total'        => $total,
            'flash'        => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function eventAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $evStore = new DataStore('events');
        $errors = [];
        $formData = $this->getEventDefaults();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getEventFormData();
            $errors = $this->validateEvent($formData, $evStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $evStore->count() + 1;
                $evStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Evenimentul a fost creat cu succes.'];
                header('Location: /admin/evenimente');
                exit;
            }
        }

        View::render('admin/event-form', [
            'pageTitle' => 'Adauga eveniment',
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => false,
        ], 'admin');
    }

    public function eventEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $evStore = new DataStore('events');
        $id = (int) ($params['id'] ?? 0);
        $event = $evStore->find($id);

        if (!$event) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Evenimentul nu a fost gasit.'];
            header('Location: /admin/evenimente');
            exit;
        }

        $errors = [];
        $formData = $event;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getEventFormData();
            $errors = $this->validateEvent($formData, $evStore, $id);

            if (empty($errors)) {
                $evStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Evenimentul a fost actualizat.'];
                header('Location: /admin/evenimente');
                exit;
            }
        }

        View::render('admin/event-form', [
            'pageTitle' => 'Editeaza: ' . ($event['title'] ?? ''),
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => true,
        ], 'admin');
    }

    public function eventDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $evStore = new DataStore('events');
        $evStore->delete((int) ($params['id'] ?? 0));
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Evenimentul a fost sters.'];
        header('Location: /admin/evenimente');
        exit;
    }

    // ─── CARIERE ─────────────────────────────────────────────

    public function jobs(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $jobStore = new DataStore('jobs');
        $allJobs = $jobStore->all();

        // Filters
        $filterStatus = $_GET['status'] ?? '';
        $search = trim($_GET['q'] ?? '');

        if ($filterStatus) {
            $allJobs = array_filter($allJobs, fn($j) => ($j['status'] ?? 'activ') === $filterStatus);
        }
        if ($search) {
            $q = mb_strtolower($search);
            $allJobs = array_filter($allJobs, fn($j) =>
                str_contains(mb_strtolower($j['title'] ?? ''), $q) ||
                str_contains(mb_strtolower($j['slug'] ?? ''), $q) ||
                str_contains(mb_strtolower($j['location'] ?? ''), $q)
            );
        }

        $allJobs = array_values($allJobs);
        usort($allJobs, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

        View::render('admin/jobs', [
            'pageTitle'    => 'Cariere - Joburi',
            'jobs'         => $allJobs,
            'filterStatus' => $filterStatus,
            'search'       => $search,
            'total'        => count($allJobs),
            'flash'        => $_SESSION['_flash'] ?? null,
        ], 'admin');

        unset($_SESSION['_flash']);
    }

    public function jobAdd(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $jobStore = new DataStore('jobs');
        $errors = [];
        $formData = $this->getJobDefaults();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getJobFormData();
            $errors = $this->validateJob($formData, $jobStore);

            if (empty($errors)) {
                $formData['sort_order'] = $formData['sort_order'] ?: $jobStore->count() + 1;
                $jobStore->create($formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Jobul a fost creat cu succes.'];
                header('Location: /admin/cariere');
                exit;
            }
        }

        View::render('admin/job-form', [
            'pageTitle' => 'Adauga job',
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => false,
        ], 'admin');
    }

    public function jobEdit(array $params, array $route): void
    {
        Auth::requireRole('editor');

        $jobStore = new DataStore('jobs');
        $id = (int) ($params['id'] ?? 0);
        $job = $jobStore->find($id);

        if (!$job) {
            $_SESSION['_flash'] = ['type' => 'error', 'message' => 'Jobul nu a fost gasit.'];
            header('Location: /admin/cariere');
            exit;
        }

        $errors = [];
        $formData = $job;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Auth::requireCsrf();
            $formData = $this->getJobFormData();
            $errors = $this->validateJob($formData, $jobStore, $id);

            if (empty($errors)) {
                $jobStore->update($id, $formData);
                $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Jobul a fost actualizat.'];
                header('Location: /admin/cariere');
                exit;
            }
        }

        View::render('admin/job-form', [
            'pageTitle' => 'Editeaza: ' . ($job['title'] ?? ''),
            'formData'  => $formData,
            'errors'    => $errors,
            'isEdit'    => true,
        ], 'admin');
    }

    public function jobDelete(array $params, array $route): void
    {
        Auth::requireRole('administrator');
        Auth::requireCsrf();

        $jobStore = new DataStore('jobs');
        $jobStore->delete((int) ($params['id'] ?? 0));
        $_SESSION['_flash'] = ['type' => 'success', 'message' => 'Jobul a fost sters.'];
        header('Location: /admin/cariere');
        exit;
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

    private function getProductDefaults(): array
    {
        return [
            'name' => '', 'subtitle' => '', 'slug' => '',
            'category_id' => 0, 'subcategory_id' => 0,
            'manufacturer' => '', 'status' => 'draft',
            'image_main' => '', 'image_schema' => '', 'gallery' => [],
            'specs' => [], 'materials' => [],
            'warranty_text' => '', 'description_html' => '',
            'seo_title' => '', 'seo_description' => '',
            'related_products' => [], 'sort_order' => 0, 'is_active' => true,
        ];
    }

    private function getProductFormData(): array
    {
        // Parse specs from dynamic rows
        $specKeys = $_POST['spec_key'] ?? [];
        $specValues = $_POST['spec_value'] ?? [];
        $specs = [];
        $specOrder = 1;
        foreach ($specKeys as $i => $key) {
            $key = trim($key);
            if ($key === '') continue;
            $specs[] = [
                'key' => $key,
                'value' => trim($specValues[$i] ?? ''),
                'sort_order' => $specOrder++,
            ];
        }

        // Parse materials from dynamic rows
        $matNames = $_POST['mat_name'] ?? [];
        $matColors = $_POST['mat_colors'] ?? [];
        $materials = [];
        $matOrder = 1;
        foreach ($matNames as $mi => $matName) {
            $matName = trim($matName);
            if ($matName === '') continue;
            $colors = [];
            $colorOrder = 1;
            $cNames = $matColors[$mi]['name'] ?? [];
            $cCodes = $matColors[$mi]['code'] ?? [];
            $cHexes = $matColors[$mi]['hex'] ?? [];
            foreach ($cNames as $ci => $cName) {
                $cName = trim($cName);
                if ($cName === '') continue;
                $colors[] = [
                    'name' => $cName,
                    'code' => trim($cCodes[$ci] ?? ''),
                    'hex' => trim($cHexes[$ci] ?? '#cccccc'),
                    'swatch' => '',
                    'sort_order' => $colorOrder++,
                ];
            }
            $materials[] = [
                'name' => $matName,
                'sort_order' => $matOrder++,
                'colors' => $colors,
            ];
        }

        // Parse gallery
        $galleryRaw = array_filter(array_map('trim', explode("\n", $_POST['gallery_urls'] ?? '')));

        // Parse related products
        $relatedRaw = $_POST['related_products'] ?? [];
        if (is_string($relatedRaw)) {
            $relatedRaw = array_filter(array_map('trim', explode(',', $relatedRaw)));
        }

        return [
            'name'             => trim($_POST['name'] ?? ''),
            'subtitle'         => trim($_POST['subtitle'] ?? ''),
            'slug'             => trim($_POST['slug'] ?? ''),
            'category_id'      => (int) ($_POST['category_id'] ?? 0),
            'subcategory_id'   => (int) ($_POST['subcategory_id'] ?? 0),
            'manufacturer'     => trim($_POST['manufacturer'] ?? ''),
            'status'           => $_POST['status'] ?? 'draft',
            'image_main'       => trim($_POST['image_main'] ?? ''),
            'image_schema'     => trim($_POST['image_schema'] ?? ''),
            'gallery'          => $galleryRaw,
            'specs'            => $specs,
            'materials'        => $materials,
            'warranty_text'    => trim($_POST['warranty_text'] ?? ''),
            'description_html' => $_POST['description_html'] ?? '',
            'seo_title'        => trim($_POST['seo_title'] ?? ''),
            'seo_description'  => trim($_POST['seo_description'] ?? ''),
            'related_products' => $relatedRaw,
            'sort_order'       => (int) ($_POST['sort_order'] ?? 0),
            'is_active'        => !empty($_POST['is_active']),
        ];
    }

    private function validateProduct(array $data, DataStore $store, ?int $excludeId = null): array
    {
        $errors = [];
        if (empty($data['name'])) {
            $errors[] = 'Numele produsului este obligatoriu.';
        }
        if (empty($data['slug'])) {
            $errors[] = 'Slug-ul este obligatoriu.';
        } elseif (!preg_match('/^[a-z0-9\-]+$/', $data['slug'])) {
            $errors[] = 'Slug-ul poate contine doar litere mici, cifre si cratime.';
        } elseif ($store->slugExists($data['slug'], $excludeId)) {
            $errors[] = 'Acest slug exista deja.';
        }
        if (empty($data['category_id'])) {
            $errors[] = 'Selectati categoria.';
        }
        if (empty($data['subcategory_id'])) {
            $errors[] = 'Selectati subcategoria.';
        }
        return $errors;
    }

    // ─── BLOG HELPERS ──────────────────────────────────────

    private function getBlogDefaults(): array
    {
        return [
            'title' => '', 'slug' => '', 'excerpt' => '', 'content' => '',
            'category_id' => 0, 'image_featured' => '', 'author' => 'Echipa BDM Systems',
            'date' => date('Y-m-d'), 'read_time' => 0, 'tags' => [],
            'related_products' => [], 'image_icon' => '', 'image_color' => '#1a4a7a',
            'status' => 'draft', 'seo_title' => '', 'seo_description' => '', 'sort_order' => 0,
        ];
    }

    private function getBlogFormData(): array
    {
        $tags = array_filter(array_map('trim', explode(',', $_POST['tags'] ?? '')));

        $relatedRaw = $_POST['related_products'] ?? [];
        if (is_string($relatedRaw)) {
            $relatedRaw = array_filter(array_map('trim', explode(',', $relatedRaw)));
        }

        // Build related products array from paired inputs
        $rpSlugs = $_POST['rp_slug'] ?? [];
        $rpNames = $_POST['rp_name'] ?? [];
        $related = [];
        foreach ($rpSlugs as $i => $slug) {
            $slug = trim($slug);
            $name = trim($rpNames[$i] ?? '');
            if ($slug !== '') {
                $related[] = ['slug' => $slug, 'name' => $name ?: $slug];
            }
        }

        return [
            'title'            => trim($_POST['title'] ?? ''),
            'slug'             => trim($_POST['slug'] ?? ''),
            'excerpt'          => trim($_POST['excerpt'] ?? ''),
            'content'          => $_POST['content'] ?? '',
            'category_id'      => (int) ($_POST['category_id'] ?? 0),
            'image_featured'   => trim($_POST['image_featured'] ?? ''),
            'author'           => trim($_POST['author'] ?? 'Echipa BDM Systems'),
            'date'             => $_POST['date'] ?? date('Y-m-d'),
            'read_time'        => (int) ($_POST['read_time'] ?? 0),
            'tags'             => $tags,
            'related_products' => $related,
            'image_icon'       => trim($_POST['image_icon'] ?? ''),
            'image_color'      => trim($_POST['image_color'] ?? '#1a4a7a'),
            'status'           => $_POST['status'] ?? 'draft',
            'seo_title'        => trim($_POST['seo_title'] ?? ''),
            'seo_description'  => trim($_POST['seo_description'] ?? ''),
            'sort_order'       => (int) ($_POST['sort_order'] ?? 0),
        ];
    }

    private function validateBlogArticle(array $data, DataStore $store, ?int $excludeId = null): array
    {
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = 'Titlul articolului este obligatoriu.';
        }
        if (empty($data['slug'])) {
            $errors[] = 'Slug-ul este obligatoriu.';
        } elseif (!preg_match('/^[a-z0-9\-]+$/', $data['slug'])) {
            $errors[] = 'Slug-ul poate contine doar litere mici, cifre si cratime.';
        } elseif ($store->slugExists($data['slug'], $excludeId)) {
            $errors[] = 'Acest slug exista deja.';
        }
        if (empty($data['category_id'])) {
            $errors[] = 'Selectati categoria.';
        }
        if (empty($data['content'])) {
            $errors[] = 'Continutul articolului este obligatoriu.';
        }
        return $errors;
    }

    private function getBlogCategoryFormData(): array
    {
        return [
            'name'        => trim($_POST['name'] ?? ''),
            'slug'        => trim($_POST['slug'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'icon'        => trim($_POST['icon'] ?? ''),
            'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
        ];
    }

    private function validateBlogCategory(array $data, DataStore $store, ?int $excludeId = null): array
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

    // ─── VIDEO HELPERS ──────────────────────────────────────

    private function getVideoDefaults(): array
    {
        return [
            'title' => '', 'slug' => '', 'description' => '',
            'tiktok_url' => '', 'tiktok_id' => '', 'thumbnail' => '',
            'category_id' => 0, 'subcategory_id' => 0,
            'published_at' => date('Y-m-d'),
            'is_active' => true, 'sort_order' => 0,
        ];
    }

    private function getVideoFormData(): array
    {
        $tiktokUrl = trim($_POST['tiktok_url'] ?? '');
        $tiktokId = trim($_POST['tiktok_id'] ?? '');

        // Auto-extract tiktok_id from URL server-side
        if ($tiktokUrl && !$tiktokId) {
            if (preg_match('/video\/(\d+)/', $tiktokUrl, $m)) {
                $tiktokId = $m[1];
            }
        }

        return [
            'title'           => trim($_POST['title'] ?? ''),
            'slug'            => trim($_POST['slug'] ?? ''),
            'description'     => trim($_POST['description'] ?? ''),
            'tiktok_url'      => $tiktokUrl,
            'tiktok_id'       => $tiktokId,
            'thumbnail'       => trim($_POST['thumbnail'] ?? ''),
            'category_id'     => (int) ($_POST['category_id'] ?? 0),
            'subcategory_id'  => (int) ($_POST['subcategory_id'] ?? 0),
            'published_at'    => $_POST['published_at'] ?? date('Y-m-d'),
            'is_active'       => !empty($_POST['is_active']),
            'sort_order'      => (int) ($_POST['sort_order'] ?? 0),
        ];
    }

    private function validateVideo(array $data, DataStore $store, ?int $excludeId = null): array
    {
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = 'Titlul videoului este obligatoriu.';
        }
        if (empty($data['slug'])) {
            $errors[] = 'Slug-ul este obligatoriu.';
        } elseif (!preg_match('/^[a-z0-9\-]+$/', $data['slug'])) {
            $errors[] = 'Slug-ul poate contine doar litere mici, cifre si cratime.';
        } elseif ($store->slugExists($data['slug'], $excludeId)) {
            $errors[] = 'Acest slug exista deja.';
        }
        if (empty($data['tiktok_url'])) {
            $errors[] = 'URL-ul TikTok este obligatoriu.';
        }
        if (empty($data['category_id'])) {
            $errors[] = 'Selectati categoria.';
        }
        if (empty($data['subcategory_id'])) {
            $errors[] = 'Selectati subcategoria.';
        }
        if (mb_strlen($data['description'] ?? '') > 200) {
            $errors[] = 'Descrierea nu poate depasi 200 caractere.';
        }
        return $errors;
    }

    private function getVideoCategoryFormData(): array
    {
        return [
            'name'       => trim($_POST['name'] ?? ''),
            'slug'       => trim($_POST['slug'] ?? ''),
            'parent_id'  => (int) ($_POST['parent_id'] ?? 0),
            'icon'       => trim($_POST['icon'] ?? ''),
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
            'is_active'  => !empty($_POST['is_active']),
        ];
    }

    private function validateVideoCategory(array $data, DataStore $store, ?int $excludeId = null): array
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

    // ─── EVENT HELPERS ──────────────────────────────────────

    private function getEventDefaults(): array
    {
        return [
            'title' => '', 'slug' => '', 'description' => '', 'content' => '',
            'image' => '', 'location' => '', 'event_date' => date('Y-m-d'),
            'event_time' => '', 'status' => 'draft', 'sort_order' => 0,
        ];
    }

    private function getEventFormData(): array
    {
        return [
            'title'       => trim($_POST['title'] ?? ''),
            'slug'        => trim($_POST['slug'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'content'     => $_POST['content'] ?? '',
            'image'       => trim($_POST['image'] ?? ''),
            'location'    => trim($_POST['location'] ?? ''),
            'event_date'  => $_POST['event_date'] ?? date('Y-m-d'),
            'event_time'  => trim($_POST['event_time'] ?? ''),
            'status'      => $_POST['status'] ?? 'draft',
            'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
        ];
    }

    private function validateEvent(array $data, DataStore $store, ?int $excludeId = null): array
    {
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = 'Titlul evenimentului este obligatoriu.';
        }
        if (empty($data['slug'])) {
            $errors[] = 'Slug-ul este obligatoriu.';
        } elseif (!preg_match('/^[a-z0-9\-]+$/', $data['slug'])) {
            $errors[] = 'Slug-ul poate contine doar litere mici, cifre si cratime.';
        } elseif ($store->slugExists($data['slug'], $excludeId)) {
            $errors[] = 'Acest slug exista deja.';
        }
        if (empty($data['event_date'])) {
            $errors[] = 'Data evenimentului este obligatorie.';
        }
        return $errors;
    }

    // ─── JOB HELPERS ────────────────────────────────────────

    private function getJobDefaults(): array
    {
        return [
            'title' => '', 'slug' => '', 'location' => 'Bucuresti',
            'type' => 'Full-time', 'description' => '',
            'responsibilities' => '', 'requirements' => '', 'benefits' => '',
            'status' => 'activ', 'date_posted' => date('Y-m-d'), 'sort_order' => 0,
        ];
    }

    private function getJobFormData(): array
    {
        return [
            'title'            => trim($_POST['title'] ?? ''),
            'slug'             => trim($_POST['slug'] ?? ''),
            'location'         => trim($_POST['location'] ?? ''),
            'type'             => $_POST['type'] ?? 'Full-time',
            'description'      => trim($_POST['description'] ?? ''),
            'responsibilities' => trim($_POST['responsibilities'] ?? ''),
            'requirements'     => trim($_POST['requirements'] ?? ''),
            'benefits'         => trim($_POST['benefits'] ?? ''),
            'status'           => $_POST['status'] ?? 'activ',
            'date_posted'      => $_POST['date_posted'] ?? date('Y-m-d'),
            'sort_order'       => (int) ($_POST['sort_order'] ?? 0),
        ];
    }

    private function validateJob(array $data, DataStore $store, ?int $excludeId = null): array
    {
        $errors = [];
        if (empty($data['title'])) {
            $errors[] = 'Titlul jobului este obligatoriu.';
        }
        if (empty($data['slug'])) {
            $errors[] = 'Slug-ul este obligatoriu.';
        } elseif (!preg_match('/^[a-z0-9\-]+$/', $data['slug'])) {
            $errors[] = 'Slug-ul poate contine doar litere mici, cifre si cratime.';
        } elseif ($store->slugExists($data['slug'], $excludeId)) {
            $errors[] = 'Acest slug exista deja.';
        }
        if (empty($data['description'])) {
            $errors[] = 'Descrierea jobului este obligatorie.';
        }
        return $errors;
    }

    // ─── HOMEPAGE HELPERS ───────────────────────────────────

    private function loadHomepage(): array
    {
        $file = ROOT_PATH . '/data/homepage.json';
        if (!file_exists($file)) {
            return [];
        }
        return json_decode(file_get_contents($file), true) ?: [];
    }

    private function saveHomepage(array $data): void
    {
        $file = ROOT_PATH . '/data/homepage.json';
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    private function parseRepeaterItems(array $raw, array $fields): array
    {
        $items = [];
        foreach ($raw as $i => $row) {
            $item = ['id' => (int)($row['id'] ?? ($i + 1)), 'sort_order' => $i];
            foreach ($fields as $f) {
                $item[$f] = trim($row[$f] ?? '');
            }
            $item['is_active'] = !empty($row['is_active']);
            if (!empty(array_filter(array_intersect_key($item, array_flip($fields))))) {
                $items[] = $item;
            }
        }
        return $items;
    }
}
