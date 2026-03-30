<?php

namespace App\Controllers;

use App\Helpers\View;

class ProductController
{
    public function show(array $params, array $route): void
    {
        $slug = $params['slug'] ?? 'produs';
        $name = ucwords(str_replace('-', ' ', $slug));

        View::render('pages/product', [
            'pageTitle' => $name . ' - BDM Systems',
            'pageDescription' => 'Detalii produs ' . $name . ' - BDM Systems acoperisuri.info',
            'productSlug' => $slug,
            'productName' => $name,
            'breadcrumbs' => [
                ['label' => 'Produse', 'url' => '/'],
                ['label' => $name],
            ],
        ]);
    }
}
