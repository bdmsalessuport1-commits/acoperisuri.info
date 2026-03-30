<?php

namespace App\Controllers;

use App\Helpers\View;

class AdminController
{
    public function dashboard(array $params, array $route): void
    {
        View::render('admin/dashboard', [
            'pageTitle' => $route['title'] ?? 'Admin - Dashboard',
        ], 'admin');
    }

    public function products(array $params, array $route): void
    {
        View::render('admin/products', [
            'pageTitle' => $route['title'] ?? 'Admin - Produse',
        ], 'admin');
    }

    public function categories(array $params, array $route): void
    {
        View::render('admin/categories', [
            'pageTitle' => $route['title'] ?? 'Admin - Categorii',
        ], 'admin');
    }
}
