<?php

namespace App\Controllers;

use App\Helpers\View;

class CategoryController
{
    public function show(array $params, array $route): void
    {
        $slug = $params['categorie'] ?? basename(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));
        $name = $this->slugToName($slug);

        View::render('pages/category', [
            'pageTitle' => $route['title'] ?? ($name . ' - BDM Systems'),
            'pageDescription' => $route['description'] ?? ('Produse din categoria ' . $name . ' - BDM Systems acoperisuri.info'),
            'categorySlug' => $slug,
            'categoryName' => $name,
            'breadcrumbs' => [
                ['label' => $name],
            ],
        ]);
    }

    public function subcategory(array $params, array $route): void
    {
        $catSlug = $params['categorie'] ?? 'categorie';
        $subSlug = $params['subcategorie'] ?? 'subcategorie';
        $catName = $this->slugToName($catSlug);
        $subName = $this->slugToName($subSlug);

        View::render('pages/subcategory', [
            'pageTitle' => $subName . ' - ' . $catName . ' - BDM Systems',
            'pageDescription' => 'Produse ' . $subName . ' din categoria ' . $catName,
            'categorySlug' => $catSlug,
            'categoryName' => $catName,
            'subcategorySlug' => $subSlug,
            'subcategoryName' => $subName,
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
