<?php

namespace App\Controllers;

use App\Helpers\View;

class VideoController
{
    private array $videoData;

    public function __construct()
    {
        $this->videoData = require __DIR__ . '/../config/video-data.php';
    }

    public function index(array $params, array $route): void
    {
        $videos     = $this->getActiveVideos();
        $categories = $this->videoData['categories'];

        View::render('pages/video', [
            'pageTitle'          => 'Videouri acoperisuri - Sfaturi si demonstratii | BDM Systems',
            'pageDescription'    => 'Videouri TikTok cu montaj acoperis, sfaturi tehnice, sisteme pluviale si studii de caz. Urmariti-ne pe TikTok!',
            'videos'             => $videos,
            'categories'         => $categories,
            'activeCategory'     => null,
            'activeSubcategory'  => null,
            'activeCategoryName' => null,
            'totalVideos'        => count($videos),
            'breadcrumbs'        => [['label' => 'Video']],
        ]);
    }

    public function category(array $params, array $route): void
    {
        $catSlug    = $params['slug'] ?? '';
        $categories = $this->videoData['categories'];

        // Check if slug is a main category or a subcategory
        $category    = null;
        $subcategory = null;
        $parentCat   = null;

        foreach ($categories as $cat) {
            if ($cat['slug'] === $catSlug) {
                $category = $cat;
                break;
            }
            foreach ($cat['subcategories'] ?? [] as $sub) {
                if ($sub['slug'] === $catSlug) {
                    $subcategory = $sub;
                    $parentCat   = $cat;
                    break 2;
                }
            }
        }

        if (!$category && !$subcategory) {
            View::render404();
            return;
        }

        $allVideos = $this->getActiveVideos();

        if ($category) {
            $filtered = array_values(array_filter($allVideos,
                fn($v) => $v['category_slug'] === $catSlug));
            $name = $category['name'];
        } else {
            $filtered = array_values(array_filter($allVideos,
                fn($v) => $v['subcategory_slug'] === $catSlug));
            $name = $subcategory['name'];
        }

        View::render('pages/video', [
            'pageTitle'          => $name . ' - Videouri | BDM Systems',
            'pageDescription'    => 'Videouri TikTok din categoria ' . $name . '. Montaj, sfaturi si demonstratii.',
            'videos'             => $filtered,
            'categories'         => $categories,
            'activeCategory'     => $category ? $catSlug : ($parentCat['slug'] ?? null),
            'activeSubcategory'  => $subcategory ? $catSlug : null,
            'activeCategoryName' => $name,
            'totalVideos'        => count($filtered),
            'breadcrumbs'        => $subcategory
                ? [
                    ['label' => 'Video', 'url' => '/video'],
                    ['label' => $parentCat['name'], 'url' => '/video/categorie/' . $parentCat['slug']],
                    ['label' => $subcategory['name']],
                ]
                : [
                    ['label' => 'Video', 'url' => '/video'],
                    ['label' => $category['name']],
                ],
        ]);
    }

    private function getActiveVideos(): array
    {
        $videos = array_filter($this->videoData['videos'], fn($v) => $v['is_active']);
        usort($videos, fn($a, $b) => ($a['sort_order'] ?? 99) - ($b['sort_order'] ?? 99));
        return array_values($videos);
    }
}
