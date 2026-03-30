<?php

namespace App\Controllers;

use App\Helpers\View;

class HomeController
{
    public function index(array $params, array $route): void
    {
        View::render('pages/home', [
            'pageTitle' => $route['title'] ?? 'BDM Systems - acoperisuri.info',
            'pageDescription' => $route['description'] ?? '',
            'breadcrumbs' => [],
        ]);
    }
}
