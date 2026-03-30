<?php

namespace App\Controllers;

use App\Helpers\View;

class BlogController
{
    public function index(array $params, array $route): void
    {
        View::render('pages/blog', [
            'pageTitle' => $route['title'] ?? 'Blog - BDM Systems',
            'pageDescription' => $route['description'] ?? '',
            'breadcrumbs' => [
                ['label' => 'Blog'],
            ],
        ]);
    }

    public function show(array $params, array $route): void
    {
        $slug = $params['slug'] ?? 'articol';
        $name = ucwords(str_replace('-', ' ', $slug));

        View::render('pages/blog-single', [
            'pageTitle' => $name . ' - Blog BDM Systems',
            'pageDescription' => 'Articol: ' . $name,
            'articleSlug' => $slug,
            'articleTitle' => $name,
            'breadcrumbs' => [
                ['label' => 'Blog', 'url' => '/blog'],
                ['label' => $name],
            ],
        ]);
    }
}
