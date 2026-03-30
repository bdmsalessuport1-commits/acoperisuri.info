<?php

namespace App\Controllers;

use App\Helpers\SeoHelper;

class SeoController
{
    public function sitemap(array $params, array $route): void
    {
        header('Content-Type: application/xml; charset=utf-8');
        echo SeoHelper::generateSitemap();
        exit;
    }

    public function robots(array $params, array $route): void
    {
        header('Content-Type: text/plain; charset=utf-8');
        $settings = SeoHelper::settings();
        echo $settings['robots_txt'] ?? "User-agent: *\nAllow: /\n";
        exit;
    }
}
