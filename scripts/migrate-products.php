<?php
/**
 * Migrates product data from ProductController's hardcoded array to data/products.json
 * Run once: php scripts/migrate-products.php
 */

define('ROOT_PATH', dirname(__DIR__));

// PSR-4 autoloader
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $baseDir = ROOT_PATH . '/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relClass) . '.php';
    if (file_exists($file)) require $file;
});

$controller = new \App\Controllers\ProductController();
$ref = new ReflectionClass($controller);
$prop = $ref->getProperty('productData');
$prop->setAccessible(true);
$productData = $prop->getValue($controller);

// Load categories and subcategories for ID mapping
$categories = json_decode(file_get_contents(ROOT_PATH . '/data/categories.json'), true);
$subcategories = json_decode(file_get_contents(ROOT_PATH . '/data/subcategories.json'), true);

// Build slug => id maps
$catMap = [];
foreach ($categories as $cat) {
    $catMap[$cat['slug']] = $cat['id'];
}

// subcategory map: "catSlug:subSlug" => id
$subMap = [];
foreach ($subcategories as $sub) {
    $catSlug = '';
    foreach ($categories as $cat) {
        if ($cat['id'] === $sub['category_id']) {
            $catSlug = $cat['slug'];
            break;
        }
    }
    $subMap[$catSlug . ':' . $sub['slug']] = $sub['id'];
}

$products = [];
$id = 1;
$now = date('Y-m-d H:i:s');

foreach ($productData as $slug => $p) {
    $catSlug = $p['category']['slug'] ?? '';
    $subSlug = $p['subcategory']['slug'] ?? '';

    // Convert specs to array of {key, value, sort_order}
    $specs = [];
    $specOrder = 1;
    foreach ($p['specs'] ?? [] as $key => $value) {
        $specs[] = [
            'key' => $key,
            'value' => $value,
            'sort_order' => $specOrder++,
        ];
    }

    // Convert materials to array of {name, sort_order, colors: [{name, code, hex, sort_order}]}
    $materials = [];
    $matOrder = 1;
    foreach ($p['materials'] ?? [] as $matName => $colors) {
        $colorArr = [];
        $colorOrder = 1;
        foreach ($colors as $c) {
            $colorArr[] = [
                'name' => $c['name'],
                'code' => $c['code'] ?? '',
                'hex' => $c['color'] ?? '#cccccc',
                'swatch' => '',
                'sort_order' => $colorOrder++,
            ];
        }
        $materials[] = [
            'name' => $matName,
            'sort_order' => $matOrder++,
            'colors' => $colorArr,
        ];
    }

    // Convert related to array of slugs
    $relatedSlugs = [];
    foreach ($p['related'] ?? [] as $rel) {
        $relatedSlugs[] = $rel['slug'];
    }

    $products[] = [
        'id' => $id,
        'name' => $p['name'] ?? '',
        'subtitle' => $p['tagline'] ?? '',
        'slug' => $slug,
        'category_id' => $catMap[$catSlug] ?? 0,
        'subcategory_id' => $subMap[$catSlug . ':' . $subSlug] ?? 0,
        'manufacturer' => $p['brand'] ?? '',
        'status' => 'activ',
        'image_main' => '',
        'image_schema' => '',
        'gallery' => [],
        'specs' => $specs,
        'materials' => $materials,
        'warranty_text' => $p['warranty'] ?? '',
        'description_html' => $p['description'] ?? '',
        'seo_title' => '',
        'seo_description' => '',
        'related_products' => $relatedSlugs,
        'sort_order' => $id,
        'is_active' => true,
        'created_at' => $now,
        'updated_at' => $now,
    ];

    $id++;
}

$json = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents(ROOT_PATH . '/data/products.json', $json, LOCK_EX);

echo "Migrated " . count($products) . " products to data/products.json\n";

// Show category/subcategory mapping stats
$unmapped = array_filter($products, fn($p) => $p['category_id'] === 0 || $p['subcategory_id'] === 0);
if (!empty($unmapped)) {
    echo "WARNING: " . count($unmapped) . " products with unmapped category/subcategory:\n";
    foreach ($unmapped as $p) {
        echo "  - {$p['slug']}: cat_id={$p['category_id']}, sub_id={$p['subcategory_id']}\n";
    }
}
