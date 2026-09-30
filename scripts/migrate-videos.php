<?php
/**
 * Migration: Convert video-data.php to JSON DataStore files
 * Run: php scripts/migrate-videos.php
 */

define('ROOT_PATH', dirname(__DIR__));

$videoData = require ROOT_PATH . '/src/config/video-data.php';

// --- Video Categories (flat with parent_id) ---
$videoCategories = [];
$catId = 1;
$slugToId = [];

foreach ($videoData['categories'] as $sortIdx => $cat) {
    $parentId = $catId;
    $videoCategories[] = [
        'id'         => $catId,
        'name'       => $cat['name'],
        'slug'       => $cat['slug'],
        'icon'       => $cat['icon'] ?? '',
        'parent_id'  => 0,
        'sort_order' => $sortIdx + 1,
        'is_active'  => true,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
    $slugToId[$cat['slug']] = $catId;
    $catId++;

    foreach ($cat['subcategories'] ?? [] as $subIdx => $sub) {
        $videoCategories[] = [
            'id'         => $catId,
            'name'       => $sub['name'],
            'slug'       => $sub['slug'],
            'icon'       => '',
            'parent_id'  => $parentId,
            'sort_order' => $subIdx + 1,
            'is_active'  => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $slugToId[$sub['slug']] = $catId;
        $catId++;
    }
}

// --- Videos ---
$videos = [];
$vidId = 1;
foreach ($videoData['videos'] as $v) {
    $videos[] = [
        'id'              => $vidId,
        'title'           => $v['title'],
        'slug'            => $v['slug'],
        'description'     => $v['description'],
        'tiktok_url'      => $v['tiktok_url'],
        'tiktok_id'       => $v['tiktok_id'],
        'thumbnail'       => '',
        'category_id'     => $slugToId[$v['category_slug']] ?? 0,
        'subcategory_id'  => $slugToId[$v['subcategory_slug']] ?? 0,
        'published_at'    => $v['published_at'],
        'is_active'       => $v['is_active'] ?? true,
        'sort_order'      => $v['sort_order'] ?? $vidId,
        'created_at'      => ($v['published_at'] ?? date('Y-m-d')) . ' 00:00:00',
        'updated_at'      => date('Y-m-d H:i:s'),
    ];
    $vidId++;
}

// Write JSON files
$flags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;
file_put_contents(ROOT_PATH . '/data/video-categories.json', json_encode($videoCategories, $flags));
file_put_contents(ROOT_PATH . '/data/videos.json', json_encode($videos, $flags));

echo "Migrated " . count($videoCategories) . " video categories (4 parents + " . (count($videoCategories) - 4) . " subcategories)\n";
echo "Migrated " . count($videos) . " videos\n";
echo "Files: data/video-categories.json, data/videos.json\n";
