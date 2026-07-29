<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\DataStore;

class CategoryController
{
    private DataStore $catStore;
    private DataStore $subStore;
    private array $categoriesData;

    public function __construct()
    {
        $this->catStore = new DataStore('categories');
        $this->subStore = new DataStore('subcategories');

        // Construieste structura compatibila cu cea veche (categories-data.php)
        $this->categoriesData = $this->buildLegacyFormat();
    }

    public function show(array $params, array $route): void
    {
        $slug = $params['categorie'] ?? basename(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
        $data = $this->categoriesData[$slug] ?? null;

        if (!$data) {
            View::render404();
            return;
        }

        $name = $data['name'];

        View::render('pages/category', [
            'pageTitle' => $route['title'] ?? ($name . ' - BDM Systems | acoperisuri.info'),
            'pageDescription' => $route['description'] ?? ($data['description'] ?? 'Produse din categoria ' . $name),
            'categorySlug' => $slug,
            'categoryName' => $name,
            'categoryData' => $data,
            'breadcrumbs' => [
                ['label' => $name],
            ],
        ]);
    }

    public function subcategory(array $params, array $route): void
    {
        $catSlug = $params['categorie'] ?? 'categorie';
        $subSlug = $params['subcategorie'] ?? 'subcategorie';
        $catData = $this->categoriesData[$catSlug] ?? null;

        if (!$catData) {
            View::render404();
            return;
        }

        $catName = $catData['name'];
        $subName = null;

        if (!empty($catData['subcategories'])) {
            foreach ($catData['subcategories'] as $sub) {
                if ($sub['slug'] === $subSlug) {
                    $subName = $sub['name'];
                    break;
                }
            }
        }

        // 404 if subcategory not found
        if ($subName === null) {
            View::render404();
            return;
        }

        $productCtrl = new ProductController();
        $products = $productCtrl->getBySubcategory($catSlug, $subSlug);

        View::render('pages/subcategory', [
            'pageTitle' => $subName . ' - ' . $catName . ' | BDM Systems',
            'pageDescription' => 'Produse ' . $subName . ' din categoria ' . $catName . '. Preturi, specificatii si oferte.',
            'categorySlug' => $catSlug,
            'categoryName' => $catName,
            'subcategorySlug' => $subSlug,
            'subcategoryName' => $subName,
            'categoryData' => $catData,
            'subcategoryProducts' => $products,
            'breadcrumbs' => [
                ['label' => $catName, 'url' => '/' . $catSlug],
                ['label' => $subName],
            ],
        ]);
    }

    /**
     * Construieste formatul legacy (slug => data) din DataStore
     * pentru compatibilitate cu views existente
     */
    private function buildLegacyFormat(): array
    {
        $result = [];
        $allSubs = $this->subStore->all();

        foreach ($this->catStore->orderBy('sort_order') as $cat) {
            if (!($cat['is_active'] ?? true)) continue;

            $slug = $cat['slug'];
            $subs = [];
            foreach ($allSubs as $sub) {
                if (($sub['category_id'] ?? 0) === $cat['id'] && ($sub['is_active'] ?? true)) {
                    $subs[] = [
                        'slug'  => $sub['slug'],
                        'name'  => $sub['name'],
                        'count' => $sub['count'] ?? 0,
                        'icon'  => $sub['icon'] ?? $cat['icon'] ?? '',
                    ];
                }
            }

            // Sortare subcategorii dupa sort_order
            usort($subs, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

            $result[$slug] = [
                'name'          => $cat['name'],
                'description'   => $cat['description'] ?? '',
                'icon'          => $cat['icon'] ?? '',
                'subcategories' => $subs,
                'popular'       => [],
                'seo_title'     => $cat['seo_title'] ?? '',
                'seo_text'      => $cat['seo_text'] ?? '',
                'related'       => [],
            ];
        }

        return $result;
    }

    private function slugToName(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }
}
