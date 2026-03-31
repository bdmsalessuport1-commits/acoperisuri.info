<?php
/**
 * SEO Meta Tags - inclus in <head>
 * Variabile disponibile: $pageTitle, $pageDescription, $pageUrl, $pageImage, $pageType
 */
$seoSettings = \App\Helpers\SeoHelper::settings();
$siteName = $seoSettings['site_title'] ?? 'BDM Systems - acoperisuri.info';
$title = $pageTitle ?? $siteName;
$description = $pageDescription ?? ($seoSettings['default_description'] ?? 'BDM Systems - solutii complete pentru acoperisuri, tigla metalica, sisteme pluviale si accesorii montaj.');
$baseUrl = 'https://acoperisuri.info';
$requestPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$canonicalUrl = $baseUrl . $requestPath;
$fullUrl = $pageUrl ?? $canonicalUrl;
$image = $pageImage ?? '/images/logo/logo-full.png';
$absImage = str_starts_with($image, 'http') ? $image : $baseUrl . $image;
$ogType = $pageType ?? 'website';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?= htmlspecialchars($title) ?></title>
<meta name="description" content="<?= htmlspecialchars($description) ?>">
<meta name="author" content="BDM Systems">
<meta name="robots" content="index, follow">

<!-- Canonical URL -->
<link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">

<!-- Open Graph -->
<meta property="og:type" content="<?= htmlspecialchars($ogType) ?>">
<meta property="og:title" content="<?= htmlspecialchars($title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($description) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
<meta property="og:image" content="<?= htmlspecialchars($absImage) ?>">
<meta property="og:site_name" content="<?= htmlspecialchars($siteName) ?>">
<meta property="og:locale" content="ro_RO">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($title) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($description) ?>">
<meta name="twitter:image" content="<?= htmlspecialchars($absImage) ?>">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="/images/logo/favicon-32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/logo/favicon-16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="shortcut icon" href="/favicon.ico">

<!-- Preconnect + Preload fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap"></noscript>

<?php
// Google Analytics
$gaCode = $seoSettings['analytics_code'] ?? '';
if ($gaCode):
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($gaCode) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= htmlspecialchars($gaCode) ?>');</script>
<?php endif; ?>
<?php
// Google Tag Manager
$gtmId = $seoSettings['tag_manager_id'] ?? '';
if ($gtmId):
?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= htmlspecialchars($gtmId) ?>');</script>
<?php endif; ?>

<!-- Critical CSS (inline above-the-fold) -->
<style>
<?php echo \App\Helpers\AssetHelper::criticalCss(); ?>
</style>

<!-- Full CSS (async load) -->
<?php $v = '12'; ?>
<link rel="preload" as="style" href="/css/app.min.css?v=<?= $v ?>">
<link rel="stylesheet" href="/css/app.min.css?v=<?= $v ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="/css/app.min.css?v=<?= $v ?>"></noscript>
