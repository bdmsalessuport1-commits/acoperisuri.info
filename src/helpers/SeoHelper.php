<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Load SEO settings from data store
     */
    public static function settings(): array
    {
        $file = ROOT_PATH . '/data/seo-settings.json';
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), true) ?: [];
        }
        return [];
    }

    /**
     * Save SEO settings
     */
    public static function saveSettings(array $data): void
    {
        $file = ROOT_PATH . '/data/seo-settings.json';
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), LOCK_EX);
    }

    /**
     * Get 301 redirects list
     */
    public static function getRedirects(): array
    {
        $settings = self::settings();
        return $settings['redirects'] ?? [];
    }

    /**
     * Check and execute redirect if applicable
     * Returns true if redirected
     */
    public static function checkRedirect(string $uri): bool
    {
        $redirects = self::getRedirects();
        foreach ($redirects as $r) {
            if (($r['from'] ?? '') === $uri && !empty($r['to']) && ($r['active'] ?? true)) {
                header('Location: ' . $r['to'], true, 301);
                exit;
            }
        }
        return false;
    }

    /**
     * Calculate SEO score for a page (0-100)
     * Returns [score, color, issues[]]
     */
    public static function score(?string $title, ?string $description, ?string $slug): array
    {
        $score = 0;
        $issues = [];

        // Title checks (max 40 points)
        $titleLen = mb_strlen($title ?? '');
        if ($titleLen === 0) {
            $issues[] = 'Lipseste meta title';
        } elseif ($titleLen < 30) {
            $score += 15;
            $issues[] = 'Title prea scurt (' . $titleLen . ' car.) — recomandat 30-60';
        } elseif ($titleLen <= 60) {
            $score += 40;
        } else {
            $score += 25;
            $issues[] = 'Title prea lung (' . $titleLen . ' car.) — recomandat max 60';
        }

        // Description checks (max 35 points)
        $descLen = mb_strlen($description ?? '');
        if ($descLen === 0) {
            $issues[] = 'Lipseste meta description';
        } elseif ($descLen < 70) {
            $score += 15;
            $issues[] = 'Description prea scurta (' . $descLen . ' car.) — recomandat 70-160';
        } elseif ($descLen <= 160) {
            $score += 35;
        } else {
            $score += 20;
            $issues[] = 'Description prea lunga (' . $descLen . ' car.) — recomandat max 160';
        }

        // Slug checks (max 25 points)
        $slugLen = mb_strlen($slug ?? '');
        if ($slugLen === 0) {
            $issues[] = 'Lipseste slug-ul';
        } elseif ($slugLen > 60) {
            $score += 10;
            $issues[] = 'Slug prea lung (' . $slugLen . ' car.)';
        } else {
            $score += 25;
        }

        // Determine color
        if ($score >= 70) {
            $color = 'green';
        } elseif ($score >= 40) {
            $color = 'yellow';
        } else {
            $color = 'red';
        }

        return [
            'score' => $score,
            'color' => $color,
            'issues' => $issues,
        ];
    }

    /**
     * Generate sitemap XML
     */
    public static function generateSitemap(): string
    {
        $baseUrl = 'https://acoperisuri.info';
        $now = date('Y-m-d');

        $urls = [];

        // Static pages
        $urls[] = ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => '/despre-noi', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/servicii', 'priority' => '0.7', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/blog', 'priority' => '0.8', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => '/video', 'priority' => '0.6', 'changefreq' => 'weekly'];

        // Categories
        $catStore = new DataStore('categories');
        $subStore = new DataStore('subcategories');
        foreach ($catStore->orderBy('sort_order') as $cat) {
            if (!($cat['is_active'] ?? true)) continue;
            $urls[] = ['loc' => '/' . $cat['slug'], 'priority' => '0.8', 'changefreq' => 'weekly'];

            // Subcategories
            foreach ($subStore->where('category_id', $cat['id']) as $sub) {
                if (!($sub['is_active'] ?? true)) continue;
                $urls[] = ['loc' => '/' . $cat['slug'] . '/' . $sub['slug'], 'priority' => '0.7', 'changefreq' => 'weekly'];
            }
        }

        // Products
        $prodStore = new DataStore('products');
        foreach ($prodStore->all() as $prod) {
            if (($prod['status'] ?? 'draft') !== 'activ') continue;
            $urls[] = ['loc' => '/produs/' . $prod['slug'], 'priority' => '0.6', 'changefreq' => 'monthly'];
        }

        // Blog articles
        $blogStore = new DataStore('blog-articles');
        foreach ($blogStore->all() as $article) {
            if (($article['status'] ?? 'draft') === 'draft') continue;
            $urls[] = ['loc' => '/blog/' . $article['slug'], 'priority' => '0.6', 'changefreq' => 'monthly'];
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($baseUrl . $u['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . $now . "</lastmod>\n";
            $xml .= "    <changefreq>" . $u['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $u['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';
        return $xml;
    }
}
