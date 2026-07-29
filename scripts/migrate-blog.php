<?php
/**
 * Migration: Convert blog-data.php to JSON DataStore files
 * Run: php scripts/migrate-blog.php
 */

define('ROOT_PATH', dirname(__DIR__));

$blogData = require ROOT_PATH . '/src/config/blog-data.php';

// --- Blog Categories ---
$blogCategories = [];
$catId = 1;
foreach ($blogData['categories'] as $cat) {
    $blogCategories[] = [
        'id'          => $catId,
        'name'        => $cat['name'],
        'slug'        => $cat['slug'],
        'description' => '',
        'icon'        => $cat['icon'] ?? '',
        'sort_order'  => $catId,
        'created_at'  => date('Y-m-d H:i:s'),
        'updated_at'  => date('Y-m-d H:i:s'),
    ];
    $catId++;
}

// Build slug -> id map
$catMap = [];
foreach ($blogCategories as $c) {
    $catMap[$c['slug']] = $c['id'];
}

// --- Blog Articles ---
$blogArticles = [];
$artId = 1;
foreach ($blogData['articles'] as $article) {
    $blogArticles[] = [
        'id'               => $artId,
        'title'            => $article['title'],
        'slug'             => $article['slug'],
        'excerpt'          => $article['excerpt'],
        'content'          => $article['content'],
        'category_id'      => $catMap[$article['category_slug']] ?? 0,
        'image_featured'   => '',
        'author'           => $article['author'],
        'date'             => $article['date'],
        'read_time'        => $article['read_time'] ?? 0,
        'tags'             => $article['tags'] ?? [],
        'related_products' => $article['related_products'] ?? [],
        'image_icon'       => $article['image_icon'] ?? '',
        'image_color'      => $article['image_color'] ?? '',
        'status'           => 'publicat',
        'seo_title'        => '',
        'seo_description'  => '',
        'sort_order'       => $artId,
        'created_at'       => $article['date'] . ' 00:00:00',
        'updated_at'       => date('Y-m-d H:i:s'),
    ];
    $artId++;
}

// Write JSON files
$flags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT;
file_put_contents(ROOT_PATH . '/data/blog-categories.json', json_encode($blogCategories, $flags));
file_put_contents(ROOT_PATH . '/data/blog-articles.json', json_encode($blogArticles, $flags));

echo "Migrated " . count($blogCategories) . " blog categories\n";
echo "Migrated " . count($blogArticles) . " blog articles\n";
echo "Files: data/blog-categories.json, data/blog-articles.json\n";
