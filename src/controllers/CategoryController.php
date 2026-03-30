<?php

namespace App\Controllers;

use App\Helpers\View;

class CategoryController
{
    private array $categoriesData;

    public function __construct()
    {
        $this->categoriesData = require __DIR__ . '/../config/categories-data.php';
    }

    public function show(array $params, array $route): void
    {
        $slug = $params['categorie'] ?? basename(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
        $data = $this->categoriesData[$slug] ?? null;
        $name = $data['name'] ?? $this->slugToName($slug);

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
        $catName = $catData['name'] ?? $this->slugToName($catSlug);
        $subName = $this->slugToName($subSlug);

        // Gaseste numele corect al subcategoriei din datele categoriei
        if ($catData && !empty($catData['subcategories'])) {
            foreach ($catData['subcategories'] as $sub) {
                if ($sub['slug'] === $subSlug) {
                    $subName = $sub['name'];
                    break;
                }
            }
        }

        // Obtine produsele din subcategorie
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

    private function slugToName(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }
}
