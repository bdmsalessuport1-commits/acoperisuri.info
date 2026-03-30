<?php

namespace App\Helpers;

class SchemaMarkup
{
    private static string $baseUrl = 'https://acoperisuri.info';

    private static function render(array $data): string
    {
        return '<script type="application/ld+json">' . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }

    public static function organization(): string
    {
        return self::render([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'BDM Systems',
            'url' => self::$baseUrl,
            'logo' => self::$baseUrl . '/images/logo/logo-full.png',
            'description' => 'Solutii complete pentru acoperisuri - tigla metalica, tabla faltuita, sisteme pluviale, ferestre FAKRO, izolatie STEICO.',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Romania',
                'addressCountry' => 'RO',
            ],
            'sameAs' => [],
        ]);
    }

    public static function localBusiness(): string
    {
        return self::render([
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'BDM Systems',
            'url' => self::$baseUrl,
            'logo' => self::$baseUrl . '/images/logo/logo-full.png',
            'description' => 'Montaj acoperisuri, tigla metalica, sisteme pluviale, ferestre mansarda FAKRO, izolatie STEICO.',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Romania',
                'addressCountry' => 'RO',
            ],
            'priceRange' => '$$',
            'openingHours' => 'Mo-Fr 08:00-17:00, Sa 09:00-13:00',
        ]);
    }

    public static function product(array $product): string
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product['name'] ?? '',
            'description' => strip_tags($product['tagline'] ?? $product['description'] ?? ''),
            'brand' => [
                '@type' => 'Brand',
                'name' => $product['brand'] ?? '',
            ],
            'url' => self::$baseUrl . '/produs/' . ($product['slug'] ?? ''),
        ];

        if (!empty($product['image_main'])) {
            $data['image'] = self::$baseUrl . $product['image_main'];
        }

        if (!empty($product['warranty'])) {
            $data['additionalProperty'] = [
                '@type' => 'PropertyValue',
                'name' => 'Garantie',
                'value' => $product['warranty'],
            ];
        }

        return self::render($data);
    }

    public static function article(array $article): string
    {
        return self::render([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article['title'] ?? '',
            'description' => $article['excerpt'] ?? '',
            'datePublished' => $article['date'] ?? '',
            'dateModified' => $article['date'] ?? '',
            'author' => [
                '@type' => 'Organization',
                'name' => 'BDM Systems',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'BDM Systems',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => self::$baseUrl . '/images/logo/logo-full.png',
                ],
            ],
            'url' => self::$baseUrl . '/blog/' . ($article['slug'] ?? ''),
            'image' => !empty($article['image']) ? self::$baseUrl . $article['image'] : '',
        ]);
    }

    public static function breadcrumbs(array $items): string
    {
        $listItems = [];
        $pos = 1;
        foreach ($items as $item) {
            $entry = [
                '@type' => 'ListItem',
                'position' => $pos,
                'name' => $item['label'] ?? '',
            ];
            if (!empty($item['url'])) {
                $entry['item'] = self::$baseUrl . $item['url'];
            }
            $listItems[] = $entry;
            $pos++;
        }

        return self::render([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ]);
    }

    public static function faq(array $questions): string
    {
        if (empty($questions)) return '';

        $items = [];
        foreach ($questions as $q) {
            $items[] = [
                '@type' => 'Question',
                'name' => $q['question'] ?? '',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $q['answer'] ?? '',
                ],
            ];
        }

        return self::render([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $items,
        ]);
    }

    public static function video(array $video): string
    {
        return self::render([
            '@context' => 'https://schema.org',
            '@type' => 'VideoObject',
            'name' => $video['title'] ?? '',
            'description' => $video['description'] ?? $video['title'] ?? '',
            'thumbnailUrl' => $video['thumbnail'] ?? '',
            'uploadDate' => $video['published_at'] ?? '',
            'contentUrl' => $video['url'] ?? '',
        ]);
    }
}
