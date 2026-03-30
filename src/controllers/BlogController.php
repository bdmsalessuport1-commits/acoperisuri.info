<?php

namespace App\Controllers;

use App\Helpers\View;
use App\Helpers\DataStore;
use App\Helpers\SchemaMarkup;

class BlogController
{
    private DataStore $artStore;
    private DataStore $catStore;

    public function __construct()
    {
        $this->artStore = new DataStore('blog-articles');
        $this->catStore = new DataStore('blog-categories');
    }

    public function index(array $params, array $route): void
    {
        $page       = max(1, (int)($_GET['pagina'] ?? 1));
        $perPage    = 9;
        $articles   = $this->getPublishedArticles();
        $categories = $this->getCategoriesForView();

        usort($articles, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));

        $total      = count($articles);
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page       = min($page, $totalPages);
        $offset     = ($page - 1) * $perPage;
        $pageSlice  = array_slice($articles, $offset, $perPage);

        // First article on page 1 becomes the featured card
        $featured = null;
        if ($page === 1 && !empty($pageSlice)) {
            $featured = array_shift($pageSlice);
        }

        View::render('pages/blog', [
            'pageTitle'          => $route['title']       ?? 'Blog - BDM Systems',
            'pageDescription'    => $route['description'] ?? 'Articole si ghiduri despre acoperisuri, montaj, materiale si eficienta energetica.',
            'articles'           => $pageSlice,
            'featured'           => $featured,
            'categories'         => $categories,
            'popular'            => array_slice($articles, 0, 5),
            'currentPage'        => $page,
            'totalPages'         => $totalPages,
            'totalArticles'      => $total,
            'activeCategory'     => null,
            'activeCategoryName' => null,
            'breadcrumbs'        => [['label' => 'Blog']],
        ]);
    }

    public function show(array $params, array $route): void
    {
        $slug       = $params['slug'] ?? '';
        $articles   = $this->getPublishedArticles();
        $categories = $this->getCategoriesForView();

        $article = null;
        foreach ($articles as $a) {
            if ($a['slug'] === $slug) {
                $article = $a;
                break;
            }
        }

        if (!$article) {
            View::render404();
            return;
        }

        // Related: same category first, then others, max 3
        $samecat = array_values(array_filter($articles,
            fn($a) => $a['category_slug'] === $article['category_slug'] && $a['slug'] !== $slug));
        $others  = array_values(array_filter($articles,
            fn($a) => $a['category_slug'] !== $article['category_slug']));
        $related = array_slice(array_merge($samecat, $others), 0, 3);

        View::render('pages/blog-single', [
            'pageTitle'       => $article['title'] . ' | Blog BDM Systems',
            'pageDescription' => $article['excerpt'],
            'article'         => $article,
            'relatedArticles' => $related,
            'popular'         => array_slice($articles, 0, 5),
            'categories'      => $categories,
            'articleSlug'     => $slug,
            'articleTitle'    => $article['title'],
            'breadcrumbs'     => [
                ['label' => 'Blog',                    'url' => '/blog'],
                ['label' => $article['category_name'], 'url' => '/blog/categorie/' . $article['category_slug']],
                ['label' => $article['title']],
            ],
            'schemaMarkup'    => SchemaMarkup::article($article),
        ]);
    }

    public function category(array $params, array $route): void
    {
        $catSlug    = $params['slug'] ?? '';
        $articles   = $this->getPublishedArticles();
        $categories = $this->getCategoriesForView();

        $category = null;
        foreach ($categories as $c) {
            if ($c['slug'] === $catSlug) {
                $category = $c;
                break;
            }
        }

        if (!$category) {
            View::render404();
            return;
        }

        $filtered = array_values(array_filter($articles,
            fn($a) => $a['category_slug'] === $catSlug));
        usort($filtered, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));

        View::render('pages/blog', [
            'pageTitle'          => $category['name'] . ' - Blog BDM Systems',
            'pageDescription'    => 'Articole din categoria ' . $category['name'] . ' pe acoperisuri.info.',
            'articles'           => $filtered,
            'featured'           => null,
            'categories'         => $categories,
            'popular'            => array_slice($articles, 0, 5),
            'currentPage'        => 1,
            'totalPages'         => 1,
            'totalArticles'      => count($filtered),
            'activeCategory'     => $catSlug,
            'activeCategoryName' => $category['name'],
            'breadcrumbs'        => [
                ['label' => 'Blog',            'url' => '/blog'],
                ['label' => $category['name']],
            ],
        ]);
    }

    public function sitemap(array $params, array $route): void
    {
        $articles   = $this->getPublishedArticles();
        $categories = $this->getCategoriesForView();
        $base       = 'https://acoperisuri.info';

        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        echo "  <url>\n    <loc>{$base}/blog</loc>\n    <changefreq>weekly</changefreq>\n    <priority>0.8</priority>\n  </url>\n";

        foreach ($categories as $cat) {
            $loc = $base . '/blog/categorie/' . htmlspecialchars($cat['slug']);
            echo "  <url>\n    <loc>{$loc}</loc>\n    <changefreq>weekly</changefreq>\n    <priority>0.6</priority>\n  </url>\n";
        }

        foreach ($articles as $a) {
            $loc  = $base . '/blog/' . htmlspecialchars($a['slug']);
            $date = htmlspecialchars($a['date']);
            echo "  <url>\n    <loc>{$loc}</loc>\n    <lastmod>{$date}</lastmod>\n    <changefreq>monthly</changefreq>\n    <priority>0.7</priority>\n  </url>\n";
        }

        echo '</urlset>';
        exit;
    }

    /**
     * Returns published articles enriched with category_slug and category_name
     */
    private function getPublishedArticles(): array
    {
        $catMap = $this->buildCategoryMap();
        $articles = [];

        foreach ($this->artStore->all() as $a) {
            // Only published, or scheduled with past date
            $status = $a['status'] ?? 'draft';
            if ($status === 'draft') continue;
            if ($status === 'programat' && strtotime($a['date'] ?? '') > time()) continue;

            $catId = $a['category_id'] ?? 0;
            $a['category_slug'] = $catMap[$catId]['slug'] ?? '';
            $a['category_name'] = $catMap[$catId]['name'] ?? '';
            $a['date_display'] = $this->formatDateRo($a['date'] ?? '');
            $articles[] = $a;
        }

        return $articles;
    }

    private function getCategoriesForView(): array
    {
        $cats = $this->catStore->orderBy('sort_order');
        // Add count per category
        $allArticles = $this->artStore->all();
        foreach ($cats as &$cat) {
            $cat['count'] = count(array_filter($allArticles, fn($a) =>
                ($a['category_id'] ?? 0) === $cat['id'] && ($a['status'] ?? 'draft') !== 'draft'
            ));
        }
        return $cats;
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
