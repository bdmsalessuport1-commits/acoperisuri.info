<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\SchemaMarkup;
use App\Helpers\DataStore;

class HomeController
{
    public function index(array $params, array $route): void
    {
        $hpFile = ROOT_PATH . '/data/homepage.json';
        $hp = file_exists($hpFile)
            ? (json_decode(file_get_contents($hpFile), true) ?: [])
            : [];

        $sectionsOrder = $hp['sections_order'] ?? ['hero', 'categories', 'brands', 'products', 'about', 'services', 'blog', 'cta'];

        // Load featured products based on mode
        $products = $this->loadProducts($hp['products'] ?? []);

        // Load latest blog articles
        $blogArticles = $this->loadBlogArticles($hp['blog']['count'] ?? 3);

        View::render('pages/home', [
            'pageTitle'       => $route['title'] ?? 'BDM Systems - acoperisuri.info',
            'pageDescription' => $route['description'] ?? '',
            'breadcrumbs'     => [],
            'schemaMarkup'    => SchemaMarkup::organization(),
            'hp'              => $hp,
            'sectionsOrder'   => $sectionsOrder,
            'featuredProducts' => $products,
            'blogArticles'    => $blogArticles,
        ]);
    }

    private function loadProducts(array $config): array
    {
        $store = new DataStore('products');
        $mode = $config['mode'] ?? 'manual';

        if ($mode === 'manual') {
            $slugs = $config['manual_slugs'] ?? [];
            $products = [];
            foreach ($slugs as $slug) {
                $p = $store->findBySlug($slug);
                if ($p) {
                    $products[] = $p;
                }
            }
            return $products;
        }

        // auto_latest
        $all = $store->orderBy('id', 'desc');
        return array_slice($all, 0, $config['auto_count'] ?? 4);
    }

    private function loadBlogArticles(int $count): array
    {
        $store = new DataStore('blog-articles');
        $articles = [];
        foreach ($store->orderBy('date', 'desc') as $a) {
            if (($a['status'] ?? '') !== 'publicat') continue;
            $articles[] = $a;
            if (count($articles) >= $count) break;
        }
        return $articles;
    }
}
