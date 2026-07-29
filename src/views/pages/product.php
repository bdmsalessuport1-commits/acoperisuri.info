<?php
$p = $product ?? null;
$hasData = $p !== null;
$specs = $p['specs'] ?? [];
$materials = $p['materials'] ?? [];
$components = $p['components'] ?? [];
$related = $p['related'] ?? [];
$brand = $p['brand'] ?? '';
$cat = $p['category'] ?? [];
$warranty = $p['warranty'] ?? '';
$desc = $p['description'] ?? '';
$tagline = $p['tagline'] ?? '';
$imageMain = $p['image_main'] ?? '';
$imageSchema = $p['image_schema'] ?? '';
$gallery = $p['gallery'] ?? [];
// Build gallery thumbnails: main image, schema, then any extra gallery items
$galleryImages = [];
if ($imageMain) $galleryImages[] = $imageMain;
if ($imageSchema) $galleryImages[] = $imageSchema;
foreach ($gallery as $img) {
    if ($img && !in_array($img, $galleryImages)) $galleryImages[] = $img;
}
$baseUrl = ($_SERVER['REQUEST_SCHEME'] ?? 'https') . '://' . ($_SERVER['HTTP_HOST'] ?? 'acoperisuri.info');
?>

<?php if ($hasData):
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $productName,
    'description' => $tagline,
    'brand' => ['@type' => 'Brand', 'name' => $brand],
    'manufacturer' => ['@type' => 'Organization', 'name' => $brand],
    'url' => 'https://acoperisuri.info/produs/' . $productSlug,
    'offers' => [
        '@type' => 'Offer',
        'availability' => 'https://schema.org/InStock',
        'seller' => ['@type' => 'Organization', 'name' => 'BDM Systems'],
    ],
];
if ($warranty) {
    $schema['additionalProperty'] = ['@type' => 'PropertyValue', 'name' => 'Garantie', 'value' => $warranty];
}
?>
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?></script>
<?php endif; ?>

<section class="section">
    <div class="container">

        <?php if (!$hasData): ?>
        <!-- Placeholder for products without data -->
        <div class="page-placeholder" style="padding: var(--spacing-3xl) 0;">
            <div class="placeholder-icon">&#128230;</div>
            <h1><?= htmlspecialchars($productName) ?></h1>
            <p>Pagina produsului va fi completata in curand.</p>
            <a href="/" class="btn btn-primary mt-lg">Inapoi la pagina principala</a>
        </div>
        <?php else: ?>

        <!-- PRODUCT TOP: Gallery + Info -->
        <div class="product-top">

            <!-- GALERIE -->
            <div class="product-gallery">
                <?php if (!empty($galleryImages)): ?>
                <div class="gallery-main" id="galleryMain">
                    <img src="<?= htmlspecialchars($galleryImages[0]) ?>" alt="<?= htmlspecialchars($productName) ?>" id="galleryMainImg">
                </div>
                <?php if (count($galleryImages) > 1): ?>
                <div class="gallery-thumbs">
                    <?php foreach ($galleryImages as $i => $img): ?>
                        <div class="gallery-thumb <?= $i === 0 ? 'active' : '' ?>" data-img="<?= htmlspecialchars($img) ?>">
                            <img src="<?= htmlspecialchars($img) ?>" alt="thumb <?= $i + 1 ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <div class="gallery-main" id="galleryMain">&#9650;</div>
                <div class="gallery-thumbs">
                    <div class="gallery-thumb active">&#9650;</div>
                    <div class="gallery-thumb">&#128208;</div>
                    <div class="gallery-thumb">&#128209;</div>
                    <div class="gallery-thumb">&#128202;</div>
                </div>
                <?php endif; ?>
            </div>

            <!-- INFO PRODUS -->
            <div class="product-info">

                <div class="product-brand-badge">
                    &#127942; <?= htmlspecialchars($brand) ?>
                </div>

                <h1><?= htmlspecialchars($productName) ?></h1>
                <p class="product-tagline"><?= htmlspecialchars($tagline) ?></p>

                <!-- SPECIFICATII -->
                <?php if (!empty($specs)): ?>
                <div class="specs-section">
                    <h3>Specificatii tehnice</h3>
                    <table class="specs-table">
                        <?php foreach ($specs as $label => $value): ?>
                            <tr>
                                <td><?= htmlspecialchars($label) ?></td>
                                <td><?= htmlspecialchars($value) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>

                <!-- CULORI PER MATERIAL -->
                <?php if (!empty($materials)): ?>
                <div class="colors-section">
                    <h3>Culori disponibile</h3>
                    <div class="material-tabs">
                        <?php $first = true; foreach ($materials as $matName => $colors): ?>
                            <button class="material-tab <?= $first ? 'active' : '' ?>" data-material="mat-<?= htmlspecialchars(strtolower(str_replace(' ', '-', $matName))) ?>">
                                <?= htmlspecialchars($matName) ?> (<?= count($colors) ?>)
                            </button>
                        <?php $first = false; endforeach; ?>
                    </div>
                    <?php $first = true; foreach ($materials as $matName => $colors): ?>
                        <div class="material-panel <?= $first ? 'active' : '' ?>" id="mat-<?= htmlspecialchars(strtolower(str_replace(' ', '-', $matName))) ?>">
                            <div class="color-grid">
                                <?php foreach ($colors as $c): ?>
                                    <div class="color-swatch-item">
                                        <?php if (!empty($c['swatch'])): ?>
                                            <div class="color-preview color-preview-image">
                                                <img src="<?= htmlspecialchars($c['swatch']) ?>" alt="<?= htmlspecialchars($c['name']) ?>" loading="lazy">
                                            </div>
                                        <?php else: ?>
                                            <div class="color-preview" style="background-color: <?= htmlspecialchars($c['color']) ?>;"></div>
                                        <?php endif; ?>
                                        <div class="color-name"><?= htmlspecialchars($c['name']) ?></div>
                                        <div class="color-code"><?= htmlspecialchars($c['code']) ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php $first = false; endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- GARANTIE -->
                <?php if ($warranty): ?>
                <div class="warranty-box">
                    <div class="warranty-icon">&#128737;</div>
                    <div class="warranty-text">
                        <h4>Garantie producator</h4>
                        <p><?= htmlspecialchars($warranty) ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- CTA -->
                <div class="product-cta">
                    <h3>Solicita oferta pentru <?= htmlspecialchars($productName) ?></h3>
                    <a href="#offerForm" class="btn btn-primary btn-lg">Solicita oferta</a>
                    <a href="tel:+40756034734" class="phone-link">sau suna: 0756.034.734</a>
                </div>

            </div>
        </div>

        <!-- FORMULAR CERERE OFERTA -->
        <div id="offerForm" class="offer-form" style="margin-top: var(--spacing-2xl);">
            <h3>Cerere oferta - <?= htmlspecialchars($productName) ?></h3>
            <form id="productOfferForm" method="post">
                <input type="hidden" name="product" value="<?= htmlspecialchars($productName) ?>">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-md);">
                    <div class="form-group">
                        <label for="offer-name">Nume complet *</label>
                        <input type="text" id="offer-name" name="name" required placeholder="Ion Popescu">
                    </div>
                    <div class="form-group">
                        <label for="offer-phone">Telefon *</label>
                        <input type="tel" id="offer-phone" name="phone" required placeholder="07xx xxx xxx">
                    </div>
                </div>
                <div class="form-group">
                    <label for="offer-email">Email</label>
                    <input type="email" id="offer-email" name="email" placeholder="email@exemplu.ro">
                </div>
                <div class="form-group">
                    <label for="offer-message">Mesaj / Detalii proiect</label>
                    <textarea id="offer-message" name="message" placeholder="Suprafata acoperis, numar foi, culoare dorita, etc."><?= htmlspecialchars($productName) ?> - Solicit oferta de pret.</textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" style="width:100%; justify-content:center;">Trimite cererea de oferta</button>
            </form>
            <div class="form-success" id="formSuccess">
                &#10004; Cererea a fost trimisa cu succes! Va vom contacta in cel mai scurt timp.
            </div>
        </div>

        <!-- DESCRIERE PRODUS -->
        <?php if ($desc): ?>
        <div class="product-description">
            <?= $desc ?>
        </div>
        <?php endif; ?>

        <!-- COMPONENTE SISTEM -->
        <?php if (!empty($components)): ?>
        <div class="system-components">
            <h2>Componentele sistemului</h2>
            <p class="components-intro">Fiecare element este proiectat pentru o potrivire perfecta si o etansare de lunga durata.</p>
            <div class="components-grid">
                <?php foreach ($components as $i => $comp): ?>
                    <div class="component-card">
                        <div class="component-card-name"><?= htmlspecialchars($comp['name']) ?></div>
                        <div class="component-img">
                            <?php if (!empty($comp['image'])): ?>
                                <img src="<?= htmlspecialchars($comp['image']) ?>" alt="<?= htmlspecialchars($comp['name']) ?>" loading="lazy">
                            <?php endif; ?>
                            <div class="component-number"><?= $i + 1 ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- PRODUSE CONEXE -->
        <?php if (!empty($related)): ?>
        <div class="related-products">
            <h2>Produse similare</h2>
            <div class="related-grid">
                <?php foreach ($related as $rel): ?>
                    <a href="/produs/<?= htmlspecialchars($rel['slug']) ?>" class="related-card">
                        <div class="related-card-img">&#9650;</div>
                        <div class="related-card-body">
                            <h4><?= htmlspecialchars($rel['name']) ?></h4>
                            <span><?= htmlspecialchars($rel['brand']) ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php endif; ?>
    </div>
</section>

<script>
// Material tabs
document.querySelectorAll('.material-tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.material-tab').forEach(function(t) { t.classList.remove('active'); });
        document.querySelectorAll('.material-panel').forEach(function(p) { p.classList.remove('active'); });
        this.classList.add('active');
        var panel = document.getElementById(this.getAttribute('data-material'));
        if (panel) panel.classList.add('active');
    });
});

// Simple form handling
var form = document.getElementById('productOfferForm');
if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        form.style.display = 'none';
        document.getElementById('formSuccess').style.display = 'block';
    });
}

// Gallery thumbnail switching
document.querySelectorAll('.gallery-thumb[data-img]').forEach(function(thumb) {
    thumb.addEventListener('click', function() {
        document.querySelectorAll('.gallery-thumb').forEach(function(t) { t.classList.remove('active'); });
        this.classList.add('active');
        var mainImg = document.getElementById('galleryMainImg');
        if (mainImg) mainImg.src = this.getAttribute('data-img');
    });
});
</script>
