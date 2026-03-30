<?php

namespace App\Controllers;

use App\Helpers\View;

class VideoController
{
    public function index(array $params, array $route): void
    {
        View::render('pages/video', [
            'pageTitle' => $route['title'] ?? 'Video - BDM Systems',
            'pageDescription' => $route['description'] ?? '',
            'breadcrumbs' => [
                ['label' => 'Video'],
            ],
        ]);
    }
}
