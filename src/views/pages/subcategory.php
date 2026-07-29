<?php
$catSlug = $categorySlug ?? '';
$catName = $categoryName ?? '';
$subSlug = $subcategorySlug ?? '';
$subName = $subcategoryName ?? '';
$catData = $categoryData ?? null;
$products = $subcategoryProducts ?? [];
$productCount = count($products);
?>

<!-- Schema.org BreadcrumbList -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type": "ListItem", "position": 1, "name": "Acasa", "item": "https://acoperisuri.info/"},
        {"@type": "ListItem", "position": 2, "name": "<?= htmlspecialchars($catName) ?>", "item": "https://acoperisuri.info/<?= htmlspecialchars($catSlug) ?>"},
        {"@type": "ListItem", "position": 3, "name": "<?= htmlspecialchars($subName) ?>"}
    ]
}
</script>

<!-- HERO -->
<section class="category-hero">
    <div class="container">
        <h1><?= htmlspecialchars($subName) ?></h1>
        <p class="category-hero-desc">
            Gama completa de produse <?= htmlspecialchars($subName) ?> din categoria <?= htmlspecialchars($catName) ?>.
            Specificatii tehnice, culori disponibile si oferte personalizate.
        </p>
        <?php if ($productCount > 0): ?>
        <span class="badge-count">&#9650; <?= $productCount ?> <?= $productCount === 1 ? 'produs' : 'produse' ?></span>
        <?php endif; ?>
    </div>
</section>

<!-- CONTENT -->
<section class="section">
    <div class="container">
        <div class="category-layout">

            <!-- PRODUCTS GRID -->
            <div class="category-content">

                <?php if (empty($products)): ?>
                <div class="page-placeholder" style="padding: var(--spacing-2xl) 0;">
                    <div class="placeholder-icon">&#128230;</div>
                    <h2><?= htmlspecialchars($subName) ?></h2>
                    <p>Produsele din aceasta subcategorie vor fi disponibile in curand.</p>
                    <a href="/<?= htmlspecialchars($catSlug) ?>" class="btn btn-primary mt-lg">
                        Vezi toate <?= htmlspecialchars($catName) ?>
                    </a>
                </div>
                <?php else: ?>

                <h2 class="subcat-section-title"><?= htmlspecialchars($subName) ?> - toate modelele</h2>

                <div class="products-grid">
                    <?php foreach ($products as $slug => $p): ?>
                    <a href="/produs/<?= htmlspecialchars($slug) ?>" class="product-card">
                        <div class="product-card-img">
                            &#9650;
                        </div>
                        <div class="product-card-body">
                            <span class="product-card-brand"><?= htmlspecialchars($p['brand'] ?? '') ?></span>
                            <h3><?= htmlspecialchars($p['name'] ?? '') ?></h3>
                            <p class="product-card-tagline"><?= htmlspecialchars($p['tagline'] ?? '') ?></p>

                            <?php
                            $specs = $p['specs'] ?? [];
                            $firstSpecs = array_slice($specs, 0, 3, true);
                            ?>
                            <?php if (!empty($firstSpecs)): ?>
                            <div class="product-card-specs">
                                <?php foreach ($firstSpecs as $label => $value): ?>
                                <div class="product-card-spec">
                                    <span class="spec-label"><?= htmlspecialchars($label) ?></span>
                                    <span class="spec-value"><?= htmlspecialchars($value) ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                            <?php
                            $materials = $p['materials'] ?? [];
                            $allColors = [];
                            foreach ($materials as $colors) {
                                foreach ($colors as $c) {
                                    $allColors[] = $c['color'];
                                }
                            }
                            $previewColors = array_slice($allColors, 0, 6);
                            ?>
                            <?php if (!empty($previewColors)): ?>
                            <div class="product-card-colors">
                                <?php foreach ($previewColors as $hex): ?>
                                <span class="color-dot" style="background-color: <?= htmlspecialchars($hex) ?>;"></span>
                                <?php endforeach; ?>
                                <?php if (count($allColors) > 6): ?>
                                <span class="color-more">+<?= count($allColors) - 6 ?></span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <span class="btn btn-sm btn-outline-green">Detalii &rarr;</span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>

                <?php endif; ?>

                <!-- CTA -->
                <div class="subcat-cta-box">
                    <h3>Solicitati oferta pentru <?= htmlspecialchars($subName) ?></h3>
                    <p>Consultanta gratuita, masuratori si montaj profesional in toata tara.</p>
                    <div class="subcat-cta-actions">
                        <a href="/contact" class="btn btn-primary">Cerere oferta</a>
                        <a href="tel:+40756034734" class="btn btn-outline">&#128222; 0756.034.734</a>
                    </div>
                </div>

            </div>

            <!-- SIDEBAR -->
            <aside class="category-sidebar">

                <!-- Alte subcategorii -->
                <?php if ($catData && !empty($catData['subcategories'])): ?>
                <div class="sidebar-box">
                    <h4>Alte branduri - <?= htmlspecialchars($catName) ?></h4>
                    <div class="sidebar-links">
                        <?php foreach ($catData['subcategories'] as $sub): ?>
                        <a href="/<?= htmlspecialchars($catSlug) ?>/<?= htmlspecialchars($sub['slug']) ?>"
                           <?= $sub['slug'] === $subSlug ? 'class="active-sub"' : '' ?>>
                            <span>
                                <?php if ($sub['slug'] === $subSlug): ?>
                                &#9654; <?= htmlspecialchars($sub['name']) ?>
                                <?php else: ?>
                                <?= htmlspecialchars($sub['name']) ?>
                                <?php endif; ?>
                            </span>
                            <span class="link-arrow">&#8594;</span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Inapoi la categorie -->
                <div class="sidebar-box">
                    <h4>Categorie</h4>
                    <div class="sidebar-links">
                        <a href="/<?= htmlspecialchars($catSlug) ?>">
                            <span>&#8592; Toate <?= htmlspecialchars($catName) ?></span>
                        </a>
                    </div>
                </div>

                <!-- Categorii conexe -->
                <?php if ($catData && !empty($catData['related'])): ?>
                <div class="sidebar-box">
                    <h4>Categorii conexe</h4>
                    <div class="sidebar-links">
                        <?php foreach ($catData['related'] as $rel): ?>
                        <a href="<?= htmlspecialchars($rel['slug']) ?>">
                            <span><?= htmlspecialchars($rel['name']) ?></span>
                            <span class="link-arrow">&#8594;</span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- CTA sidebar -->
                <div class="sidebar-box sidebar-cta">
                    <h4>Consultanta gratuita</h4>
                    <p>Expertii nostri va ajuta sa alegeti produsele potrivite pentru proiectul dumneavoastra.</p>
                    <a href="tel:+40756034734" class="btn btn-accent">&#128222; Suna acum</a>
                </div>

            </aside>
        </div>
    </div>
</section>
