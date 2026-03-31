<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\DataStore;

class VideoController
{
    private DataStore $vidStore;
    private DataStore $catStore;

    public function __construct()
    {
        $this->vidStore = new DataStore('videos');
        $this->catStore = new DataStore('video-categories');
    }

    public function index(array $params, array $route): void
    {
        $videos     = $this->getActiveVideos();
        $categories = $this->getCategoriesForView();

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
        $categories = $this->getCategoriesForView();
        $catMap     = $this->buildCategoryMap();

        // Find matching category or subcategory by slug
        $category    = null;
        $subcategory = null;
        $parentCat   = null;

        foreach ($catMap as $c) {
            if ($c['slug'] === $catSlug && ($c['parent_id'] ?? 0) === 0) {
                $category = $c;
                break;
            }
            if ($c['slug'] === $catSlug && ($c['parent_id'] ?? 0) > 0) {
                $subcategory = $c;
                $parentCat = $catMap[$c['parent_id']] ?? null;
                break;
            }
        }

        if (!$category && !$subcategory) {
            View::render404();
            return;
        }

        $allVideos = $this->getActiveVideos();

        if ($category) {
            // Filter by parent category: include videos in this category or any of its subcategories
            $childIds = array_column(array_filter($catMap, fn($c) => ($c['parent_id'] ?? 0) === $category['id']), 'id');
            $allIds = array_merge([$category['id']], $childIds);
            $filtered = array_values(array_filter($allVideos, fn($v) =>
                in_array($v['category_id'] ?? 0, $allIds) || in_array($v['subcategory_id'] ?? 0, $allIds)
            ));
            $name = $category['name'];
        } else {
            $filtered = array_values(array_filter($allVideos,
                fn($v) => ($v['subcategory_id'] ?? 0) === $subcategory['id']));
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
                    ['label' => $parentCat['name'] ?? '', 'url' => '/video/categorie/' . ($parentCat['slug'] ?? '')],
                    ['label' => $subcategory['name']],
                ]
                : [
                    ['label' => 'Video', 'url' => '/video'],
                    ['label' => $category['name']],
                ],
        ]);
    }

    /**
     * Returns active videos enriched with category/subcategory slugs and names
     */
    private function getActiveVideos(): array
    {
        $catMap = $this->buildCategoryMap();
        $videos = [];

        foreach ($this->vidStore->all() as $v) {
            if (empty($v['is_active'])) continue;

            $catId = $v['category_id'] ?? 0;
            $subId = $v['subcategory_id'] ?? 0;
            $v['category_slug'] = $catMap[$catId]['slug'] ?? '';
            $v['category_name'] = $catMap[$catId]['name'] ?? '';
            $v['subcategory_slug'] = $catMap[$subId]['slug'] ?? '';
            $v['subcategory_name'] = $catMap[$subId]['name'] ?? '';
            $v['date_display'] = $this->formatDateRo($v['published_at'] ?? '');
            $videos[] = $v;
        }

        usort($videos, fn($a, $b) => ($a['sort_order'] ?? 99) - ($b['sort_order'] ?? 99));
        return $videos;
    }

    /**
     * Builds hierarchical categories array for frontend view
     * Returns array of parent categories, each with 'subcategories' array
     */
    private function getCategoriesForView(): array
    {
        $allCats = $this->catStore->orderBy('sort_order');
        $parents = [];
        $children = [];

        foreach ($allCats as $c) {
            if (empty($c['is_active'])) continue;
            if (($c['parent_id'] ?? 0) === 0) {
                $c['subcategories'] = [];
                $parents[$c['id']] = $c;
            } else {
                $children[] = $c;
            }
        }

        foreach ($children as $ch) {
            $pid = $ch['parent_id'] ?? 0;
            if (isset($parents[$pid])) {
                $parents[$pid]['subcategories'][] = $ch;
            }
        }

        return array_values($parents);
    }

    private function buildCategoryMap(): array
    {
        $map = [];
        foreach ($this->catStore->all() as $c) {
            $map[$c['id']] = $c;
        }
        return $map;
    }

    private function formatDateRo(string $date): string
    {
        $months = [1=>'ianuarie',2=>'februarie',3=>'martie',4=>'aprilie',5=>'mai',6=>'iunie',
            7=>'iulie',8=>'august',9=>'septembrie',10=>'octombrie',11=>'noiembrie',12=>'decembrie'];
        $ts = strtotime($date);
        if (!$ts) return $date;
        return date('j', $ts) . ' ' . ($months[(int)date('n', $ts)] ?? '') . ' ' . date('Y', $ts);
    }
}
