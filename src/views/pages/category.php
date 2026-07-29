<?php
$hasData = !empty($categoryData);
$subcategories = $categoryData['subcategories'] ?? [];
$popular = $categoryData['popular'] ?? [];
$seoText = $categoryData['seo_text'] ?? '';
$related = $categoryData['related'] ?? [];
$icon = $categoryData['icon'] ?? '&#128193;';
$desc = $categoryData['description'] ?? 'Produse din categoria ' . $categoryName . ' - in constructie.';
$totalProducts = 0;
foreach ($subcategories as $sc) { $totalProducts += $sc['count'] ?? 0; }
?>

<!-- Schema.org BreadcrumbList -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "<?= htmlspecialchars($categoryName) ?>",
    "description": "<?= htmlspecialchars($desc) ?>",
    "url": "<?= htmlspecialchars(($_SERVER['REQUEST_SCHEME'] ?? 'https') . '://' . ($_SERVER['HTTP_HOST'] ?? 'acoperisuri.info') . '/' . $categorySlug) ?>",
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type": "ListItem", "position": 1, "name": "Acasa", "item": "<?= htmlspecialchars(($_SERVER['REQUEST_SCHEME'] ?? 'https') . '://' . ($_SERVER['HTTP_HOST'] ?? 'acoperisuri.info')) ?>"},
            {"@type": "ListItem", "position": 2, "name": "<?= htmlspecialchars($categoryName) ?>"}
        ]
    }
}
</script>

<!-- HERO CATEGORIE -->
<section class="category-hero">
    <div class="container">
        <h1><?= htmlspecialchars($categoryName) ?></h1>
        <p class="category-hero-desc"><?= htmlspecialchars($desc) ?></p>
        <?php if ($totalProducts > 0): ?>
            <div class="badge-count">
                <?= $icon ?> <?= $totalProducts ?> produse disponibile
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CONTENT + SIDEBAR -->
<section class="section">
    <div class="container">
        <div class="category-layout">

            <!-- MAIN CONTENT -->
            <div class="category-content">

                <?php if (!empty($subcategories)): ?>
                <!-- GRILA SUBCATEGORII -->
                <div class="subcat-grid">
                    <?php foreach ($subcategories as $sub): ?>
                        <a href="/<?= htmlspecialchars($categorySlug) ?>/<?= htmlspecialchars($sub['slug']) ?>" class="subcat-card">
                            <div class="subcat-card-image"><?= $sub['icon'] ?? $icon ?></div>
                            <div class="subcat-card-body">
                                <h3><?= htmlspecialchars($sub['name']) ?></h3>
                                <span class="product-count"><?= $sub['count'] ?? 0 ?> produse</span>
                                <div class="view-link">Vezi produsele &rarr;</div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="page-placeholder" style="padding: var(--spacing-2xl) 0;">
                    <div class="placeholder-icon"><?= $icon ?></div>
                    <h2><?= htmlspecialchars($categoryName) ?></h2>
                    <p>Produsele din aceasta categorie vor fi adaugate in curand.</p>
                </div>
                <?php endif; ?>

                <?php if (!empty($seoText)): ?>
                <!-- TEXT SEO -->
                <div class="seo-text">
                    <?= $seoText ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($popular)): ?>
                <!-- PRODUSE POPULARE -->
                <div class="popular-products">
                    <h2>Cele mai populare din <?= htmlspecialchars($categoryName) ?></h2>
                    <div class="popular-grid">
                        <?php foreach ($popular as $prod): ?>
                            <a href="/produs/<?= htmlspecialchars($prod['slug']) ?>" class="popular-card">
                                <div class="popular-card-img">&#9650;</div>
                                <div class="popular-card-body">
                                    <h4><?= htmlspecialchars($prod['name']) ?></h4>
                                    <span><?= htmlspecialchars($prod['brand']) ?></span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <!-- SIDEBAR -->
            <aside class="category-sidebar">

                <?php if (!empty($subcategories)): ?>
                <div class="sidebar-box">
                    <h4>Producatori</h4>
                    <div class="sidebar-links">
                        <?php foreach ($subcategories as $sub): ?>
                            <a href="/<?= htmlspecialchars($categorySlug) ?>/<?= htmlspecialchars($sub['slug']) ?>">
                                <?= htmlspecialchars($sub['name']) ?>
                                <span class="link-arrow">&#9654;</span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($related)): ?>
                <div class="sidebar-box">
                    <h4>Categorii inrudite</h4>
                    <div class="sidebar-links">
                        <?php foreach ($related as $rel): ?>
                            <a href="<?= htmlspecialchars($rel['slug']) ?>">
                                <?= htmlspecialchars($rel['name']) ?>
                                <span class="link-arrow">&#9654;</span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="sidebar-box sidebar-cta">
                    <h4>Solicita oferta</h4>
                    <p>Ai nevoie de o oferta personalizata pentru <?= htmlspecialchars(strtolower($categoryName)) ?>?</p>
                    <a href="/contact" class="btn btn-primary">Contacteaza-ne</a>
                    <p style="margin-top: var(--spacing-md); margin-bottom: 0;">
                        <a href="tel:+40756034734" style="color: #fff;">&#128222; 0756.034.734</a>
                    </p>
                </div>
            </aside>

        </div>
    </div>
</section>
