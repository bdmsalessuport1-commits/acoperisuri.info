<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\View;

class AdminController
{
    public function __construct()
    {
        Auth::requireAuth();
    }

    public function dashboard(array $params, array $route): void
    {
        // Incarca date reale pentru statistici
        $blogData = require ROOT_PATH . '/src/config/blog-data.php';
        $videoData = require ROOT_PATH . '/src/config/video-data.php';
        $categoriesData = require ROOT_PATH . '/src/config/categories-data.php';

        $articles = $blogData['articles'] ?? [];
        $videos = array_filter($videoData['videos'] ?? [], fn($v) => $v['is_active'] ?? true);

        // Numara produse din categorii
        $totalProducts = 0;
        foreach ($categoriesData as $cat) {
            foreach ($cat['subcategories'] ?? [] as $sub) {
                $totalProducts += $sub['count'] ?? 0;
            }
        }

        $stats = [
            'categories' => count($categoriesData),
            'products'   => $totalProducts,
            'articles'   => count($articles),
            'videos'     => count($videos),
        ];

        // Ultimele 5 articole (sortate dupa data desc)
        usort($articles, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
        $recentArticles = array_slice($articles, 0, 5);

        // Ultimele 5 videouri
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

    public function products(array $params, array $route): void
    {
        Auth::requireRole('editor');

        View::render('admin/products', [
            'pageTitle' => 'Produse',
        ], 'admin');
    }

    public function categories(array $params, array $route): void
    {
        Auth::requireRole('editor');

        View::render('admin/categories', [
            'pageTitle' => 'Categorii',
        ], 'admin');
    }

    public function blog(array $params, array $route): void
    {
        Auth::requireRole('editor');

        View::render('admin/blog', [
            'pageTitle' => 'Blog - Articole',
        ], 'admin');
    }

    public function videos(array $params, array $route): void
    {
        Auth::requireRole('editor');

        View::render('admin/videos', [
            'pageTitle' => 'Videouri TikTok',
        ], 'admin');
    }

    public function media(array $params, array $route): void
    {
        Auth::requireRole('editor');

        View::render('admin/media', [
            'pageTitle' => 'Media',
        ], 'admin');
    }

    public function seo(array $params, array $route): void
    {
        Auth::requireRole('administrator');

        View::render('admin/seo', [
            'pageTitle' => 'SEO',
        ], 'admin');
    }

    public function homepage(array $params, array $route): void
    {
        Auth::requireRole('administrator');

        View::render('admin/homepage', [
            'pageTitle' => 'Homepage',
        ], 'admin');
    }

    public function messages(array $params, array $route): void
    {
        View::render('admin/messages', [
            'pageTitle' => 'Mesaje / Lead-uri',
        ], 'admin');
    }

    public function users(array $params, array $route): void
    {
        Auth::requireRole('administrator');

        View::render('admin/users', [
            'pageTitle' => 'Utilizatori',
        ], 'admin');
    }

    public function settings(array $params, array $route): void
    {
        Auth::requireRole('administrator');

        View::render('admin/settings', [
            'pageTitle' => 'Setari',
        ], 'admin');
    }
}
