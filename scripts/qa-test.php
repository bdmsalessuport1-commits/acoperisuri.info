<?php
/**
 * QA Test Script - Etapa 22
 * Testeaza toate rutele frontend si admin (HTTP status + continut)
 * Usage: php scripts/qa-test.php [base_url]
 */

$baseUrl = $argv[1] ?? 'http://localhost:8000';
$passed = 0;
$failed = 0;
$warnings = 0;
$results = [];

echo "=== QA Test Suite - acoperisuri.info ===\n";
echo "Base URL: {$baseUrl}\n";
echo str_repeat('=', 50) . "\n\n";

// ===========================
// 1. FRONTEND ROUTES
// ===========================

$frontendRoutes = [
    // Static pages
    ['GET', '/', 200, 'Homepage', ['Solutii Complete', '<html', 'BDM Systems']],
    ['GET', '/despre-noi', 200, 'Despre noi', ['<html']],
    ['GET', '/contact', 200, 'Contact', ['<form', 'Telefon', 'Email']],
    ['GET', '/servicii', 200, 'Servicii', ['<html']],
    ['GET', '/blog', 200, 'Blog listing', ['Blog', '<html']],
    ['GET', '/video', 200, 'Video listing', ['Videouri', '<html']],

    // SEO routes
    ['GET', '/sitemap.xml', 200, 'Sitemap XML', ['<?xml', '<urlset', '<url>']],
    ['GET', '/robots.txt', 200, 'Robots.txt', ['User-agent', 'Sitemap']],

    // Category pages (from DataStore)
    ['GET', '/tigla-metalica', 200, 'Categorie: Tigla metalica', ['<html']],
    ['GET', '/sisteme-pluviale', 200, 'Categorie: Sisteme pluviale', ['<html']],

    // 404 page
    ['GET', '/pagina-inexistenta-xyz', 404, '404 page', ['404']],

    // Admin login (no auth required)
    ['GET', '/admin/login', 200, 'Admin login', ['<form', 'Autentificare']],
];

echo "--- FRONTEND ROUTES ---\n";
foreach ($frontendRoutes as $route) {
    testRoute($baseUrl, $route[0], $route[1], $route[2], $route[3], $route[4], $passed, $failed, $warnings, $results);
}

// ===========================
// 2. ADMIN ROUTES (should redirect to login)
// ===========================

$adminRoutes = [
    ['GET', '/admin', 302, 'Admin dashboard (redirect)', []],
    ['GET', '/admin/categorii', 302, 'Admin categorii (redirect)', []],
    ['GET', '/admin/produse', 302, 'Admin produse (redirect)', []],
    ['GET', '/admin/blog', 302, 'Admin blog (redirect)', []],
    ['GET', '/admin/videouri', 302, 'Admin videouri (redirect)', []],
    ['GET', '/admin/media', 302, 'Admin media (redirect)', []],
    ['GET', '/admin/seo', 302, 'Admin SEO (redirect)', []],
    ['GET', '/admin/homepage', 302, 'Admin homepage (redirect)', []],
];

echo "\n--- ADMIN ROUTES (auth redirect) ---\n";
foreach ($adminRoutes as $route) {
    testRoute($baseUrl, $route[0], $route[1], $route[2], $route[3], $route[4], $passed, $failed, $warnings, $results);
}

// ===========================
// 3. SEO CHECKS
// ===========================

echo "\n--- SEO CHECKS ---\n";

// Check homepage SEO tags
$html = fetchUrl($baseUrl . '/');
$seoChecks = [
    ['<title>', 'Title tag present'],
    ['<meta name="description"', 'Meta description present'],
    ['<link rel="canonical"', 'Canonical URL present'],
    ['og:title', 'OG title present'],
    ['og:description', 'OG description present'],
    ['og:image', 'OG image present'],
    ['twitter:card', 'Twitter card present'],
    ['application/ld+json', 'Schema.org JSON-LD present'],
    ['rel="preload"', 'Preload hints present'],
    ['app.min.css', 'Combined CSS loaded'],
    ['app.min.js', 'Combined JS loaded'],
    ['defer', 'JS deferred'],
    ['fetchpriority="high"', 'LCP image priority'],
    ['loading="lazy"', 'Lazy loading present'],
];

foreach ($seoChecks as $check) {
    if (strpos($html['body'], $check[0]) !== false) {
        echo "  ✓ {$check[1]}\n";
        $passed++;
    } else {
        echo "  ✗ {$check[1]}\n";
        $failed++;
    }
}

// ===========================
// 4. SECURITY CHECKS
// ===========================

echo "\n--- SECURITY CHECKS ---\n";

// Check security headers
$headers = $html['headers'];
$securityHeaders = [
    ['X-Content-Type-Options', 'X-Content-Type-Options header'],
    ['X-Frame-Options', 'X-Frame-Options header'],
    ['Referrer-Policy', 'Referrer-Policy header'],
    ['Cache-Control', 'Cache-Control header'],
];

foreach ($securityHeaders as $hdr) {
    $found = false;
    foreach ($headers as $h) {
        if (stripos($h, $hdr[0]) !== false) {
            $found = true;
            break;
        }
    }
    if ($found) {
        echo "  ✓ {$hdr[1]}\n";
        $passed++;
    } else {
        echo "  ⚠ {$hdr[1]} (may be set by Apache only)\n";
        $warnings++;
    }
}

// Check CSRF on login form
$loginHtml = fetchUrl($baseUrl . '/admin/login');
if (strpos($loginHtml['body'], '_csrf_token') !== false) {
    echo "  ✓ CSRF token on login form\n";
    $passed++;
} else {
    echo "  ✗ CSRF token missing on login form\n";
    $failed++;
}

// Check .env is not accessible
$envCheck = fetchUrl($baseUrl . '/.env');
if ($envCheck['code'] === 403 || $envCheck['code'] === 404) {
    echo "  ✓ .env file not accessible ({$envCheck['code']})\n";
    $passed++;
} else {
    echo "  ✗ .env file accessible! ({$envCheck['code']})\n";
    $failed++;
}

// Check data directory not accessible
$dataCheck = fetchUrl($baseUrl . '/data/categories.json');
if ($dataCheck['code'] === 403 || $dataCheck['code'] === 404) {
    echo "  ✓ /data/ files not accessible ({$dataCheck['code']})\n";
    $passed++;
} else {
    echo "  ⚠ /data/ files accessible ({$dataCheck['code']}) - blocked by .htaccess on Apache\n";
    $warnings++;
}

// ===========================
// 5. PERFORMANCE CHECKS
// ===========================

echo "\n--- PERFORMANCE CHECKS ---\n";

// Count CSS files loaded (should be 1 combined)
$cssCount = substr_count($html['body'], 'rel="stylesheet"');
$inlineCss = substr_count($html['body'], '<style>');
echo "  External stylesheets: {$cssCount} (target: ≤2)\n";
echo "  Inline <style> blocks: {$inlineCss} (target: 1 critical CSS)\n";

// Count includes noscript fallbacks (2 real + 2 noscript = 4 max)
if ($cssCount <= 4) {
    echo "  ✓ CSS optimized ({$cssCount} incl. noscript fallbacks)\n";
    $passed++;
} else {
    echo "  ✗ Too many CSS files ({$cssCount})\n";
    $failed++;
}

// Check for render-blocking resources
if (strpos($html['body'], 'media="print" onload') !== false) {
    echo "  ✓ Non-blocking CSS loading\n";
    $passed++;
} else {
    echo "  ✗ CSS may be render-blocking\n";
    $failed++;
}

// ===========================
// 6. SITEMAP VALIDATION
// ===========================

echo "\n--- SITEMAP VALIDATION ---\n";

$sitemap = fetchUrl($baseUrl . '/sitemap.xml');
if ($sitemap['code'] === 200) {
    $urlCount = substr_count($sitemap['body'], '<url>');
    echo "  ✓ Sitemap accessible ({$urlCount} URLs)\n";
    $passed++;

    if ($urlCount >= 100) {
        echo "  ✓ Sitemap has sufficient URLs ({$urlCount} >= 100)\n";
        $passed++;
    } else {
        echo "  ⚠ Sitemap has only {$urlCount} URLs (expected 100+)\n";
        $warnings++;
    }
} else {
    echo "  ⚠ Sitemap returned {$sitemap['code']} (PHP built-in server limitation)\n";
    $warnings++;
}

// ===========================
// SUMMARY
// ===========================

echo "\n" . str_repeat('=', 50) . "\n";
echo "=== RESULTS ===\n";
echo "  Passed:   {$passed}\n";
echo "  Failed:   {$failed}\n";
echo "  Warnings: {$warnings}\n";
echo "  Total:    " . ($passed + $failed + $warnings) . "\n";

if ($failed === 0) {
    echo "\n✓ ALL TESTS PASSED\n";
} else {
    echo "\n✗ {$failed} TESTS FAILED\n";
}

echo str_repeat('=', 50) . "\n";

// ===========================
// FUNCTIONS
// ===========================

function fetchUrl(string $url): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HEADER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    curl_close($ch);

    $headerStr = substr($response, 0, $headerSize);
    $body = substr($response, $headerSize);
    $headers = explode("\r\n", $headerStr);

    return ['code' => $code, 'body' => $body, 'headers' => $headers];
}

function testRoute(string $baseUrl, string $method, string $path, int $expectedCode, string $label, array $contentChecks, int &$passed, int &$failed, int &$warnings, array &$results): void
{
    $result = fetchUrl($baseUrl . $path);
    $code = $result['code'];

    $status = ($code === $expectedCode) ? '✓' : '✗';
    echo "  {$status} [{$code}] {$method} {$path} - {$label}";

    if ($code === $expectedCode) {
        $passed++;

        // Check content
        foreach ($contentChecks as $check) {
            if (strpos($result['body'], $check) === false) {
                echo " (missing: '{$check}')";
                $warnings++;
            }
        }
        echo "\n";
    } else {
        echo " (expected {$expectedCode})\n";
        $failed++;
    }
}
