<?php
/**
 * Build script: Concatenate + minify CSS and JS
 * Usage: php scripts/build-assets.php
 */

$root = dirname(__DIR__);
$publicDir = $root . '/public';

// ===========================
// CSS MINIFICATION
// ===========================

$cssFiles = [
    'variables.css',
    'base.css',
    'header.css',
    'footer.css',
    'homepage.css',
    'category.css',
    'product.css',
    'blog.css',
    'video.css',
    'pages.css',
];

echo "=== Building CSS ===\n";

$combined = '';
foreach ($cssFiles as $file) {
    $path = $publicDir . '/css/' . $file;
    if (file_exists($path)) {
        $combined .= "/* {$file} */\n" . file_get_contents($path) . "\n";
        echo "  + {$file} (" . round(filesize($path) / 1024, 1) . " KB)\n";
    } else {
        echo "  ! Missing: {$file}\n";
    }
}

$originalSize = strlen($combined);

// Minify CSS
$minified = minifyCss($combined);
$minifiedSize = strlen($minified);

file_put_contents($publicDir . '/css/app.min.css', $minified);

echo "  Original: " . round($originalSize / 1024, 1) . " KB\n";
echo "  Minified: " . round($minifiedSize / 1024, 1) . " KB\n";
echo "  Saved: " . round(($originalSize - $minifiedSize) / 1024, 1) . " KB (" . round((1 - $minifiedSize / $originalSize) * 100) . "%)\n\n";

// ===========================
// JS MINIFICATION
// ===========================

echo "=== Building JS ===\n";

$jsFile = $publicDir . '/js/header.js';
if (file_exists($jsFile)) {
    $jsContent = file_get_contents($jsFile);
    $jsOriginal = strlen($jsContent);
    $jsMinified = minifyJs($jsContent);
    $jsMinSize = strlen($jsMinified);

    file_put_contents($publicDir . '/js/app.min.js', $jsMinified);

    echo "  Original: " . round($jsOriginal / 1024, 1) . " KB\n";
    echo "  Minified: " . round($jsMinSize / 1024, 1) . " KB\n";
    echo "  Saved: " . round(($jsOriginal - $jsMinSize) / 1024, 1) . " KB (" . round((1 - $jsMinSize / $jsOriginal) * 100) . "%)\n\n";
}

echo "=== Build complete ===\n";

// ===========================
// FUNCTIONS
// ===========================

function minifyCss(string $css): string
{
    // Remove comments
    $css = preg_replace('/\/\*[\s\S]*?\*\//', '', $css);
    // Remove whitespace around selectors and properties
    $css = preg_replace('/\s+/', ' ', $css);
    // Remove spaces around { } : ; ,
    $css = preg_replace('/\s*{\s*/', '{', $css);
    $css = preg_replace('/\s*}\s*/', '}', $css);
    $css = preg_replace('/\s*:\s*/', ':', $css);
    $css = preg_replace('/\s*;\s*/', ';', $css);
    $css = preg_replace('/\s*,\s*/', ',', $css);
    // Remove last semicolon before }
    $css = str_replace(';}', '}', $css);
    // Remove leading/trailing whitespace
    return trim($css);
}

function minifyJs(string $js): string
{
    // Remove single-line comments (but not URLs with //)
    $js = preg_replace('/(?<!:)\/\/[^\n]*/', '', $js);
    // Remove multi-line comments
    $js = preg_replace('/\/\*[\s\S]*?\*\//', '', $js);
    // Collapse whitespace
    $js = preg_replace('/\s+/', ' ', $js);
    // Remove spaces around operators (safe subset)
    $js = preg_replace('/\s*([{}();,=<>!|&+\-])\s*/', '$1', $js);
    // Restore space after keywords
    $js = preg_replace('/(var|if|else|function|return|typeof|new|for|in|of|let|const|class)([({])/', '$1 $2', $js);
    $js = preg_replace('/(else){/', '$1 {', $js);
    $js = preg_replace('/}(else)/', '} $1', $js);
    return trim($js);
}
