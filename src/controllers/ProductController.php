<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\DataStore;

class ProductController
{
    private DataStore $prodStore;

    public function __construct()
    {
        $this->prodStore = new DataStore('products');
    }

    public function show(array $params, array $route): void
    {
        $slug = $params['slug'] ?? 'produs';
        $product = $this->prodStore->findBySlug($slug);

        if (!$product) {
            $name = ucwords(str_replace('-', ' ', $slug));
            View::render('pages/product', [
                'pageTitle' => $name . ' | BDM Systems',
                'pageDescription' => 'Detalii produs ' . $name,
                'productSlug' => $slug,
                'productName' => $name,
                'product' => null,
                'breadcrumbs' => [['label' => $name]],
            ]);
            return;
        }

        // Build legacy format for view compatibility
        $data = $this->toLegacyFormat($product);
        $name = $data['name'];

        View::render('pages/product', [
            'pageTitle' => ($name . ' - ' . $data['brand']) . ' | BDM Systems',
            'pageDescription' => $data['tagline'] ?? 'Detalii produs ' . $name,
            'productSlug' => $slug,
            'productName' => $name,
            'product' => $data,
            'breadcrumbs' => [
                ['label' => $data['category']['name'], 'url' => '/' . $data['category']['slug']],
                ['label' => $data['subcategory']['name'], 'url' => '/' . $data['category']['slug'] . '/' . $data['subcategory']['slug']],
                ['label' => $name],
            ],
        ]);
    }

    /**
     * Returneaza produsele filtrate dupa categorie si subcategorie
     */
    public function getBySubcategory(string $catSlug, string $subSlug): array
    {
        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');

        $cat = $catStore->findBySlug($catSlug);
        $catId = $cat['id'] ?? 0;

        // Find subcategory by slug within category
        $subId = 0;
        foreach ($subStore->where('category_id', $catId) as $sub) {
            if (($sub['slug'] ?? '') === $subSlug) {
                $subId = $sub['id'];
                break;
            }
        }

        $products = [];
        foreach ($this->prodStore->all() as $p) {
            if (($p['category_id'] ?? 0) === $catId && ($p['subcategory_id'] ?? 0) === $subId && ($p['status'] ?? 'draft') === 'activ') {
                $products[$p['slug']] = $this->toLegacyFormat($p);
            }
        }
        return $products;
    }

    /**
     * Returneaza produsele filtrate dupa categorie
     */
    public function getByCategory(string $catSlug): array
    {
        $catStore = new DataStore('categories');
        $cat = $catStore->findBySlug($catSlug);
        $catId = $cat['id'] ?? 0;

        $products = [];
        foreach ($this->prodStore->all() as $p) {
            if (($p['category_id'] ?? 0) === $catId && ($p['status'] ?? 'draft') === 'activ') {
                $products[$p['slug']] = $this->toLegacyFormat($p);
            }
        }
        return $products;
    }

    /**
     * Converts DataStore product format to legacy view-compatible format
     */
    private function toLegacyFormat(array $p): array
    {
        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');

        $cat = $catStore->find($p['category_id'] ?? 0);
        $sub = $subStore->find($p['subcategory_id'] ?? 0);

        // Convert specs array to key => value
        $specs = [];
        foreach ($p['specs'] ?? [] as $s) {
            $specs[$s['key']] = $s['value'];
        }

        // Convert materials array to name => colors
        $materials = [];
        foreach ($p['materials'] ?? [] as $mat) {
            $colors = [];
            foreach ($mat['colors'] ?? [] as $c) {
                $colors[] = [
                    'name' => $c['name'],
                    'code' => $c['code'] ?? '',
                    'color' => $c['hex'] ?? '#cccccc',
                    'swatch' => $c['swatch'] ?? '',
                ];
            }
            $materials[$mat['name']] = $colors;
        }

        // Convert related slugs to legacy format
        $related = [];
        foreach ($p['related_products'] ?? [] as $rSlug) {
            $rProd = $this->prodStore->findBySlug($rSlug);
            if ($rProd) {
                $related[] = [
                    'slug' => $rSlug,
                    'name' => preg_replace('/^.+?\s/', '', $rProd['name'], 1) ?: $rProd['name'],
                    'brand' => $rProd['manufacturer'] ?? '',
                ];
            }
        }

        return [
            'name' => $p['name'] ?? '',
            'tagline' => $p['subtitle'] ?? '',
            'brand' => $p['manufacturer'] ?? '',
            'category' => [
                'slug' => $cat['slug'] ?? '',
                'name' => $cat['name'] ?? '',
            ],
            'subcategory' => [
                'slug' => $sub['slug'] ?? '',
                'name' => $sub['name'] ?? '',
            ],
            'specs' => $specs,
            'materials' => $materials,
            'warranty' => $p['warranty_text'] ?? '',
            'description' => $p['description_html'] ?? '',
            'related' => $related,
        ];
    }
}
