<?php

namespace App\Controllers;

use App\Helpers\View;

class PageController
{
    public function about(array $params, array $route): void
    {
        View::render('pages/about', [
            'pageTitle' => $route['title'] ?? 'Despre noi - BDM Systems',
            'pageDescription' => $route['description'] ?? '',
            'breadcrumbs' => [
                ['label' => 'Despre noi'],
            ],
        ]);
    }

    public function contact(array $params, array $route): void
    {
        View::render('pages/contact', [
            'pageTitle' => $route['title'] ?? 'Contact - BDM Systems',
            'pageDescription' => $route['description'] ?? '',
            'breadcrumbs' => [
                ['label' => 'Contact'],
            ],
        ]);
    }
}
