<?php
/**
 * SEO Meta Tags - inclus in <head>
 * Variabile disponibile: $pageTitle, $pageDescription, $pageUrl, $pageImage
 */
$siteName = 'BDM Systems - acoperisuri.info';
$title = $pageTitle ?? $siteName;
$description = $pageDescription ?? 'BDM Systems - solutii complete pentru acoperisuri, tigla metalica, sisteme pluviale si accesorii montaj.';
$url = $pageUrl ?? ($_SERVER['REQUEST_SCHEME'] ?? 'https') . '://' . ($_SERVER['HTTP_HOST'] ?? 'acoperisuri.info') . ($_SERVER['REQUEST_URI'] ?? '/');
$image = $pageImage ?? '/images/logo/logo-full.png';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?= htmlspecialchars($title) ?></title>
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<meta name="author" content="BDM Systems">
<meta name="robots" content="index, follow">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?= htmlspecialchars($title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($description) ?>">
<meta property="og:url" content="<?= htmlspecialchars($url) ?>">
<meta property="og:image" content="<?= htmlspecialchars($image) ?>">
<meta property="og:site_name" content="<?= htmlspecialchars($siteName) ?>">
<meta property="og:locale" content="ro_RO">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="/images/logo/favicon-32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/logo/favicon-16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="shortcut icon" href="/favicon.ico">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="/css/variables.css">
<link rel="stylesheet" href="/css/base.css">
