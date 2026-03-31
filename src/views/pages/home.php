<?php
/** @var array $hp */
/** @var array $sectionsOrder */
/** @var array $featuredProducts */
/** @var array $blogArticles */

$hero       = $hp['hero'] ?? [];
$categories = $hp['categories'] ?? [];
$brands     = $hp['brands'] ?? [];
$products   = $hp['products'] ?? [];
$banners    = $hp['banners'] ?? [];
$about      = $hp['about'] ?? [];
$services   = $hp['services'] ?? [];
$blogCfg    = $hp['blog'] ?? [];
$cta        = $hp['cta'] ?? [];

$months = [1=>'Ianuarie',2=>'Februarie',3=>'Martie',4=>'Aprilie',5=>'Mai',6=>'Iunie',
    7=>'Iulie',8=>'August',9=>'Septembrie',10=>'Octombrie',11=>'Noiembrie',12=>'Decembrie'];
?>

<?php foreach ($sectionsOrder as $section): ?>

<?php if ($section === 'hero'): ?>
<?php $slides = $hero['slides'] ?? []; if (!empty($slides)): $slide = $slides[0]; ?>
<!-- HERO SECTION -->
<section class="hero"<?php if (!empty($slide['image'])): ?> style="background-image:url('<?= htmlspecialchars($slide['image']) ?>')"<?php endif; ?>>
    <div class="container">
        <div class="hero-content">
            <h1><?= $slide['title'] ?? '' ?></h1>
            <p class="hero-subtitle"><?= htmlspecialchars($slide['subtitle'] ?? '') ?></p>
            <div class="hero-buttons">
                <?php if (!empty($slide['button_text'])): ?>
                    <a href="<?= htmlspecialchars($slide['button_link'] ?? '#') ?>" class="btn btn-primary btn-lg"><?= htmlspecialchars($slide['button_text']) ?></a>
                <?php endif; ?>
                <?php if (!empty($slide['button2_text'])): ?>
                    <a href="<?= htmlspecialchars($slide['button2_link'] ?? '#') ?>" class="btn btn-outline-white btn-lg"><?= htmlspecialchars($slide['button2_text']) ?></a>
                <?php endif; ?>
            </div>
            <?php if (!empty($slide['badge_text'])): ?>
            <div class="hero-badge">
                <span class="badge-icon"><?= $slide['badge_icon'] ?? '' ?></span>
                <?= htmlspecialchars($slide['badge_text']) ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php elseif ($section === 'categories'): ?>
<?php $catItems = $categories['items'] ?? []; if (!empty($catItems)): ?>
<!-- GRILA CATEGORII -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><?= htmlspecialchars($categories['title'] ?? '') ?></h2>
            <p><?= htmlspecialchars($categories['subtitle'] ?? '') ?></p>
        </div>
        <div class="grid grid-4">
            <?php foreach ($catItems as $cat): if (empty($cat['is_active'])) continue; ?>
            <a href="<?= htmlspecialchars($cat['link'] ?? '#') ?>" class="category-card">
                <div class="category-card-image"><?= $cat['icon'] ?? '' ?></div>
                <div class="category-card-body">
                    <h3><?= htmlspecialchars($cat['name'] ?? '') ?></h3>
                    <p><?= htmlspecialchars($cat['description'] ?? '') ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php elseif ($section === 'brands'): ?>
<?php $brandItems = $brands['items'] ?? []; if (!empty($brandItems)): ?>
<!-- PRODUCATORI / BRANDURI -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header">
            <h2><?= htmlspecialchars($brands['title'] ?? '') ?></h2>
            <p><?= htmlspecialchars($brands['subtitle'] ?? '') ?></p>
        </div>
        <div class="brands-row">
            <?php foreach ($brandItems as $brand): if (empty($brand['is_active'])) continue; ?>
            <a href="<?= htmlspecialchars($brand['link'] ?? '#') ?>" class="brand-item">
                <span class="brand-name"><?= htmlspecialchars($brand['name'] ?? '') ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php elseif ($section === 'products'): ?>
<?php if (!empty($featuredProducts)): ?>
<!-- PRODUSE RECOMANDATE -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><?= htmlspecialchars($products['title'] ?? '') ?></h2>
            <p><?= htmlspecialchars($products['subtitle'] ?? '') ?></p>
        </div>
        <div class="products-scroll">
            <?php foreach ($featuredProducts as $prod): ?>
            <a href="/produs/<?= htmlspecialchars($prod['slug'] ?? '') ?>" class="product-card">
                <div class="product-card-image"><?= $prod['image_icon'] ?? '&#9650;' ?></div>
                <div class="product-card-body">
                    <h4><?= htmlspecialchars($prod['name'] ?? '') ?></h4>
                    <?php if (!empty($prod['brand'])): ?>
                        <span class="product-brand"><?= htmlspecialchars($prod['brand']) ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php elseif ($section === 'banners'): ?>
<?php $bannerItems = $banners['items'] ?? []; if (!empty($bannerItems)): ?>
<!-- BANNERE PROMOTIONALE -->
<?php foreach ($bannerItems as $banner): if (empty($banner['is_active'])) continue; ?>
<section class="section hp-banner"<?php if (!empty($banner['image'])): ?> style="background-image:url('<?= htmlspecialchars($banner['image']) ?>')"<?php endif; ?>>
    <div class="container">
        <div class="hp-banner-content">
            <?php if (!empty($banner['title'])): ?><h2><?= htmlspecialchars($banner['title']) ?></h2><?php endif; ?>
            <?php if (!empty($banner['text'])): ?><p><?= htmlspecialchars($banner['text']) ?></p><?php endif; ?>
            <?php if (!empty($banner['link'])): ?><a href="<?= htmlspecialchars($banner['link']) ?>" class="btn btn-primary btn-lg">Detalii</a><?php endif; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>
<?php endif; ?>

<?php elseif ($section === 'about'): ?>
<?php if (!empty($about['title'])): ?>
<!-- DESPRE BDM SYSTEMS -->
<section class="section bg-light">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <h2><?= htmlspecialchars($about['title'] ?? '') ?></h2>
                <p><?= htmlspecialchars($about['text'] ?? '') ?></p>
                <?php $features = $about['features'] ?? []; if (!empty($features)): ?>
                <div class="features-list">
                    <?php foreach ($features as $feat): ?>
                    <div class="feature-item">
                        <div class="feature-icon"><?= $feat['icon'] ?? '' ?></div>
                        <div class="feature-text">
                            <h4><?= htmlspecialchars($feat['title'] ?? '') ?></h4>
                            <p><?= htmlspecialchars($feat['text'] ?? '') ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="about-image"><?= $about['image'] ?? '' ?></div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php elseif ($section === 'services'): ?>
<?php $svcItems = $services['items'] ?? []; if (!empty($svcItems)): ?>
<!-- SERVICII -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><?= htmlspecialchars($services['title'] ?? '') ?></h2>
            <p><?= htmlspecialchars($services['subtitle'] ?? '') ?></p>
        </div>
        <div class="grid grid-3">
            <?php foreach ($svcItems as $svc): ?>
            <div class="service-card">
                <div class="service-icon"><?= $svc['icon'] ?? '' ?></div>
                <h3><?= htmlspecialchars($svc['title'] ?? '') ?></h3>
                <p><?= htmlspecialchars($svc['text'] ?? '') ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($services['cta_text'])): ?>
        <div class="text-center mt-xl">
            <a href="<?= htmlspecialchars($services['cta_link'] ?? '/contact') ?>" class="btn btn-primary btn-lg"><?= htmlspecialchars($services['cta_text']) ?></a>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php elseif ($section === 'blog'): ?>
<?php if (!empty($blogArticles)): ?>
<!-- ULTIMELE ARTICOLE BLOG -->
<section class="section bg-light">
    <div class="container">
        <div class="section-header">
            <h2><?= htmlspecialchars($blogCfg['title'] ?? 'Blog') ?></h2>
            <p><?= htmlspecialchars($blogCfg['subtitle'] ?? '') ?></p>
        </div>
        <div class="grid grid-3">
            <?php foreach ($blogArticles as $art): ?>
            <div class="blog-card">
                <div class="blog-card-image"><?= $art['image_icon'] ?? '&#128214;' ?></div>
                <div class="blog-card-body">
                    <?php
                    $ts = strtotime($art['date'] ?? '');
                    $dateDisplay = $ts ? date('j', $ts) . ' ' . ($months[(int)date('n', $ts)] ?? '') . ' ' . date('Y', $ts) : '';
                    ?>
                    <div class="blog-card-date"><?= $dateDisplay ?></div>
                    <h3><a href="/blog/<?= htmlspecialchars($art['slug'] ?? '') ?>"><?= htmlspecialchars($art['title'] ?? '') ?></a></h3>
                    <p class="blog-card-excerpt"><?= htmlspecialchars($art['excerpt'] ?? '') ?></p>
                    <a href="/blog/<?= htmlspecialchars($art['slug'] ?? '') ?>" class="read-more">Citeste mai mult &rarr;</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php elseif ($section === 'cta'): ?>
<?php if (!empty($cta['title'])): ?>
<!-- CTA FINAL -->
<section class="cta-final">
    <div class="container">
        <h2><?= htmlspecialchars($cta['title'] ?? '') ?></h2>
        <p><?= htmlspecialchars($cta['text'] ?? '') ?></p>
        <?php if (!empty($cta['button_text'])): ?>
            <a href="<?= htmlspecialchars($cta['button_link'] ?? '/contact') ?>" class="btn btn-lg"><?= htmlspecialchars($cta['button_text']) ?></a>
        <?php endif; ?>
        <?php if (!empty($cta['phone'])): ?>
        <div class="cta-phone">
            <a href="tel:+40<?= preg_replace('/[^0-9]/', '', $cta['phone']) ?>">&#128222; <?= htmlspecialchars($cta['phone']) ?></a>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php endif; ?>
<?php endforeach; ?>
