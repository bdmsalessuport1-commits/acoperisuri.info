<?php
/** @var array $homepage */
/** @var array $allProducts */
/** @var array|null $flash */
$csrfToken = \App\Helpers\Auth::csrfToken();
$hp = $homepage;
$slides = $hp['hero']['slides'] ?? [];
$catItems = $hp['categories']['items'] ?? [];
$brandItems = $hp['brands']['items'] ?? [];
$bannerItems = $hp['banners']['items'] ?? [];
$aboutFeatures = $hp['about']['features'] ?? [];
$serviceItems = $hp['services']['items'] ?? [];
$sectionsOrder = $hp['sections_order'] ?? ['hero','categories','brands','products','banners','about','services','blog','cta'];

$sectionLabels = [
    'hero' => 'Slider / Hero',
    'categories' => 'Categorii produse',
    'brands' => 'Branduri / Producatori',
    'products' => 'Produse recomandate',
    'banners' => 'Bannere promotionale',
    'about' => 'Despre noi',
    'services' => 'Servicii',
    'blog' => 'Ultimele articole blog',
    'cta' => 'CTA Final',
];
?>

<?php if ($flash): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<div class="hp-manager">

<!-- ═══════════════════════════════════════════════════
     ORDINE SECTIUNI
     ═══════════════════════════════════════════════════ -->
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <div class="admin-card-header">Ordine sectiuni pe homepage</div>
    <div class="admin-card-body">
        <form method="post" action="/admin/homepage/salveaza/ordine">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="hp-order-list" id="orderList">
                <?php foreach ($sectionsOrder as $i => $key): ?>
                <div class="hp-order-item" data-key="<?= $key ?>">
                    <input type="hidden" name="sections_order[]" value="<?= $key ?>">
                    <span class="hp-order-handle">&#9776;</span>
                    <span class="hp-order-label"><?= htmlspecialchars($sectionLabels[$key] ?? $key) ?></span>
                    <span class="hp-order-arrows">
                        <button type="button" class="btn btn-sm" onclick="moveSection(this, -1)" title="Sus">&#9650;</button>
                        <button type="button" class="btn btn-sm" onclick="moveSection(this, 1)" title="Jos">&#9660;</button>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Salveaza ordinea</button>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     SLIDER / HERO
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Slider / Hero</span>
        <span class="hp-accordion-count"><?= count($slides) ?> slide(uri)</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/hero">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div id="slidesContainer">
                <?php foreach ($slides as $i => $slide): ?>
                <div class="hp-repeater-item">
                    <div class="hp-repeater-header">
                        <strong>Slide #<?= $i + 1 ?></strong>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)">&#10005;</button>
                    </div>
                    <input type="hidden" name="slides[<?= $i ?>][id]" value="<?= $slide['id'] ?? $i+1 ?>">
                    <input type="hidden" name="slides[<?= $i ?>][is_active]" value="1">
                    <div class="admin-field-row">
                        <div class="admin-field" style="flex:2;">
                            <label>Titlu</label>
                            <input type="text" name="slides[<?= $i ?>][title]" value="<?= htmlspecialchars($slide['title'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Imagine (URL)</label>
                            <input type="text" name="slides[<?= $i ?>][image]" value="<?= htmlspecialchars($slide['image'] ?? '') ?>" placeholder="/uploads/hero.webp">
                        </div>
                    </div>
                    <div class="admin-field">
                        <label>Subtitlu</label>
                        <input type="text" name="slides[<?= $i ?>][subtitle]" value="<?= htmlspecialchars($slide['subtitle'] ?? '') ?>">
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field">
                            <label>Buton 1 text</label>
                            <input type="text" name="slides[<?= $i ?>][button_text]" value="<?= htmlspecialchars($slide['button_text'] ?? '') ?>">
                        </div>
                        <div class="admin-field">
                            <label>Buton 1 link</label>
                            <input type="text" name="slides[<?= $i ?>][button_link]" value="<?= htmlspecialchars($slide['button_link'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field">
                            <label>Buton 2 text</label>
                            <input type="text" name="slides[<?= $i ?>][button2_text]" value="<?= htmlspecialchars($slide['button2_text'] ?? '') ?>">
                        </div>
                        <div class="admin-field">
                            <label>Buton 2 link</label>
                            <input type="text" name="slides[<?= $i ?>][button2_link]" value="<?= htmlspecialchars($slide['button2_link'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field">
                            <label>Badge icon</label>
                            <input type="text" name="slides[<?= $i ?>][badge_icon]" value="<?= htmlspecialchars($slide['badge_icon'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:2;">
                            <label>Badge text</label>
                            <input type="text" name="slides[<?= $i ?>][badge_text]" value="<?= htmlspecialchars($slide['badge_text'] ?? '') ?>">
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-outline" onclick="addSlide()" style="margin-bottom: 1rem;">+ Adauga slide</button>
            <div><button type="submit" class="btn btn-primary">Salveaza Slider/Hero</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     CATEGORII AFISATE
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Categorii afisate pe homepage</span>
        <span class="hp-accordion-count"><?= count($catItems) ?> categorii</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/categorii">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="admin-field-row">
                <div class="admin-field" style="flex:1;">
                    <label>Titlu sectiune</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($hp['categories']['title'] ?? '') ?>">
                </div>
                <div class="admin-field" style="flex:2;">
                    <label>Subtitlu</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($hp['categories']['subtitle'] ?? '') ?>">
                </div>
            </div>
            <div id="categoriesContainer">
                <?php foreach ($catItems as $i => $cat): ?>
                <div class="hp-repeater-item hp-repeater-compact">
                    <input type="hidden" name="items[<?= $i ?>][id]" value="<?= $cat['id'] ?? $i+1 ?>">
                    <input type="hidden" name="items[<?= $i ?>][is_active]" value="1">
                    <div class="admin-field-row" style="align-items:flex-end;">
                        <div class="admin-field" style="width:60px;">
                            <label>Icon</label>
                            <input type="text" name="items[<?= $i ?>][icon]" value="<?= htmlspecialchars($cat['icon'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Nume</label>
                            <input type="text" name="items[<?= $i ?>][name]" value="<?= htmlspecialchars($cat['name'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:2;">
                            <label>Descriere</label>
                            <input type="text" name="items[<?= $i ?>][description]" value="<?= htmlspecialchars($cat['description'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Link</label>
                            <input type="text" name="items[<?= $i ?>][link]" value="<?= htmlspecialchars($cat['link'] ?? '') ?>">
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">&#10005;</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-outline" onclick="addCategory()" style="margin-bottom: 1rem;">+ Adauga categorie</button>
            <div><button type="submit" class="btn btn-primary">Salveaza categorii</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     BRANDURI / PRODUCATORI
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Branduri / Producatori</span>
        <span class="hp-accordion-count"><?= count($brandItems) ?> branduri</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/branduri">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="admin-field-row">
                <div class="admin-field" style="flex:1;">
                    <label>Titlu sectiune</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($hp['brands']['title'] ?? '') ?>">
                </div>
                <div class="admin-field" style="flex:2;">
                    <label>Subtitlu</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($hp['brands']['subtitle'] ?? '') ?>">
                </div>
            </div>
            <div id="brandsContainer">
                <?php foreach ($brandItems as $i => $brand): ?>
                <div class="hp-repeater-item hp-repeater-compact">
                    <input type="hidden" name="items[<?= $i ?>][id]" value="<?= $brand['id'] ?? $i+1 ?>">
                    <input type="hidden" name="items[<?= $i ?>][is_active]" value="1">
                    <div class="admin-field-row" style="align-items:flex-end;">
                        <div class="admin-field" style="flex:1;">
                            <label>Nume brand</label>
                            <input type="text" name="items[<?= $i ?>][name]" value="<?= htmlspecialchars($brand['name'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Link</label>
                            <input type="text" name="items[<?= $i ?>][link]" value="<?= htmlspecialchars($brand['link'] ?? '') ?>">
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">&#10005;</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-outline" onclick="addBrand()" style="margin-bottom: 1rem;">+ Adauga brand</button>
            <div><button type="submit" class="btn btn-primary">Salveaza branduri</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     PRODUSE RECOMANDATE
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Produse recomandate</span>
        <span class="hp-accordion-count"><?= $hp['products']['mode'] ?? 'manual' ?></span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/produse">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="admin-field-row">
                <div class="admin-field" style="flex:1;">
                    <label>Titlu sectiune</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($hp['products']['title'] ?? '') ?>">
                </div>
                <div class="admin-field" style="flex:2;">
                    <label>Subtitlu</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($hp['products']['subtitle'] ?? '') ?>">
                </div>
            </div>
            <div class="admin-field">
                <label>Mod afisare</label>
                <div class="hp-radio-group">
                    <label><input type="radio" name="mode" value="manual" <?= ($hp['products']['mode'] ?? 'manual') === 'manual' ? 'checked' : '' ?> onchange="toggleProductMode()"> Manual (selectie produse)</label>
                    <label><input type="radio" name="mode" value="auto_latest" <?= ($hp['products']['mode'] ?? '') === 'auto_latest' ? 'checked' : '' ?> onchange="toggleProductMode()"> Auto (ultimele adaugate)</label>
                </div>
            </div>
            <div id="productManualFields" style="<?= ($hp['products']['mode'] ?? 'manual') !== 'manual' ? 'display:none;' : '' ?>">
                <div class="admin-field">
                    <label>Produse selectate (slug-uri)</label>
                    <div id="productSlugsContainer">
                        <?php foreach (($hp['products']['manual_slugs'] ?? []) as $j => $slug): ?>
                        <div class="hp-repeater-compact" style="margin-bottom: 0.5rem; display:flex; gap:0.5rem; align-items:center;">
                            <select name="manual_slugs[]" class="admin-filter-select" style="flex:1;">
                                <option value="">— Selecteaza produs —</option>
                                <?php foreach ($allProducts as $p): ?>
                                    <option value="<?= htmlspecialchars($p['slug']) ?>" <?= $slug === $p['slug'] ? 'selected' : '' ?>><?= htmlspecialchars($p['name'] ?? $p['slug']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">&#10005;</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline" onclick="addProductSlug()">+ Adauga produs</button>
                </div>
            </div>
            <div id="productAutoFields" style="<?= ($hp['products']['mode'] ?? 'manual') === 'manual' ? 'display:none;' : '' ?>">
                <div class="admin-field" style="max-width: 200px;">
                    <label>Numar produse</label>
                    <input type="number" name="auto_count" value="<?= (int)($hp['products']['auto_count'] ?? 4) ?>" min="1" max="12">
                </div>
            </div>
            <div style="margin-top: 1rem;"><button type="submit" class="btn btn-primary">Salveaza produse</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     BANNERE PROMOTIONALE
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Bannere promotionale</span>
        <span class="hp-accordion-count"><?= count($bannerItems) ?> bannere</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/bannere">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div id="bannersContainer">
                <?php if (empty($bannerItems)): ?>
                    <p style="color: var(--color-text-light); margin-bottom: 1rem;">Niciun banner adaugat.</p>
                <?php endif; ?>
                <?php foreach ($bannerItems as $i => $banner): ?>
                <div class="hp-repeater-item">
                    <div class="hp-repeater-header">
                        <strong>Banner #<?= $i + 1 ?></strong>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)">&#10005;</button>
                    </div>
                    <input type="hidden" name="items[<?= $i ?>][id]" value="<?= $banner['id'] ?? $i+1 ?>">
                    <input type="hidden" name="items[<?= $i ?>][is_active]" value="1">
                    <div class="admin-field-row">
                        <div class="admin-field" style="flex:1;">
                            <label>Titlu</label>
                            <input type="text" name="items[<?= $i ?>][title]" value="<?= htmlspecialchars($banner['title'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Imagine (URL)</label>
                            <input type="text" name="items[<?= $i ?>][image]" value="<?= htmlspecialchars($banner['image'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field" style="flex:2;">
                            <label>Text</label>
                            <input type="text" name="items[<?= $i ?>][text]" value="<?= htmlspecialchars($banner['text'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Link</label>
                            <input type="text" name="items[<?= $i ?>][link]" value="<?= htmlspecialchars($banner['link'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="width:120px;">
                            <label>Pozitie</label>
                            <select name="items[<?= $i ?>][position]">
                                <option value="top" <?= ($banner['position'] ?? '') === 'top' ? 'selected' : '' ?>>Sus</option>
                                <option value="middle" <?= ($banner['position'] ?? '') === 'middle' ? 'selected' : '' ?>>Mijloc</option>
                                <option value="bottom" <?= ($banner['position'] ?? '') === 'bottom' ? 'selected' : '' ?>>Jos</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-outline" onclick="addBanner()" style="margin-bottom: 1rem;">+ Adauga banner</button>
            <div><button type="submit" class="btn btn-primary">Salveaza bannere</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     DESPRE NOI
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Sectiune "Despre noi"</span>
        <span class="hp-accordion-count"><?= count($aboutFeatures) ?> avantaje</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/despre">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="admin-field">
                <label>Titlu</label>
                <input type="text" name="title" value="<?= htmlspecialchars($hp['about']['title'] ?? '') ?>">
            </div>
            <div class="admin-field">
                <label>Text principal</label>
                <textarea name="text" rows="4"><?= htmlspecialchars($hp['about']['text'] ?? '') ?></textarea>
            </div>
            <div class="admin-field" style="max-width: 200px;">
                <label>Imagine/Icon sectiune</label>
                <input type="text" name="image" value="<?= htmlspecialchars($hp['about']['image'] ?? '') ?>">
            </div>
            <h4 style="margin: 1.5rem 0 0.75rem;">Avantaje / Features</h4>
            <div id="featuresContainer">
                <?php foreach ($aboutFeatures as $i => $feat): ?>
                <div class="hp-repeater-item hp-repeater-compact">
                    <input type="hidden" name="features[<?= $i ?>][id]" value="<?= $feat['id'] ?? $i+1 ?>">
                    <input type="hidden" name="features[<?= $i ?>][is_active]" value="1">
                    <div class="admin-field-row" style="align-items:flex-end;">
                        <div class="admin-field" style="width:70px;">
                            <label>Icon</label>
                            <input type="text" name="features[<?= $i ?>][icon]" value="<?= htmlspecialchars($feat['icon'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Titlu</label>
                            <input type="text" name="features[<?= $i ?>][title]" value="<?= htmlspecialchars($feat['title'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:2;">
                            <label>Text</label>
                            <input type="text" name="features[<?= $i ?>][text]" value="<?= htmlspecialchars($feat['text'] ?? '') ?>">
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">&#10005;</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-outline" onclick="addFeature()" style="margin-bottom: 1rem;">+ Adauga avantaj</button>
            <div><button type="submit" class="btn btn-primary">Salveaza "Despre noi"</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     SERVICII
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Servicii</span>
        <span class="hp-accordion-count"><?= count($serviceItems) ?> servicii</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/servicii">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="admin-field-row">
                <div class="admin-field" style="flex:1;">
                    <label>Titlu sectiune</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($hp['services']['title'] ?? '') ?>">
                </div>
                <div class="admin-field" style="flex:2;">
                    <label>Subtitlu</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($hp['services']['subtitle'] ?? '') ?>">
                </div>
            </div>
            <div id="servicesContainer">
                <?php foreach ($serviceItems as $i => $svc): ?>
                <div class="hp-repeater-item hp-repeater-compact">
                    <input type="hidden" name="items[<?= $i ?>][id]" value="<?= $svc['id'] ?? $i+1 ?>">
                    <input type="hidden" name="items[<?= $i ?>][is_active]" value="1">
                    <div class="admin-field-row" style="align-items:flex-end;">
                        <div class="admin-field" style="width:70px;">
                            <label>Icon</label>
                            <input type="text" name="items[<?= $i ?>][icon]" value="<?= htmlspecialchars($svc['icon'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:1;">
                            <label>Titlu</label>
                            <input type="text" name="items[<?= $i ?>][title]" value="<?= htmlspecialchars($svc['title'] ?? '') ?>">
                        </div>
                        <div class="admin-field" style="flex:2;">
                            <label>Text</label>
                            <input type="text" name="items[<?= $i ?>][text]" value="<?= htmlspecialchars($svc['text'] ?? '') ?>">
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">&#10005;</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn btn-outline" onclick="addService()" style="margin-bottom: 1rem;">+ Adauga serviciu</button>
            <div class="admin-field-row" style="margin-top: 1rem;">
                <div class="admin-field" style="flex:1;">
                    <label>Text buton CTA</label>
                    <input type="text" name="cta_text" value="<?= htmlspecialchars($hp['services']['cta_text'] ?? '') ?>">
                </div>
                <div class="admin-field" style="flex:1;">
                    <label>Link CTA</label>
                    <input type="text" name="cta_link" value="<?= htmlspecialchars($hp['services']['cta_link'] ?? '') ?>">
                </div>
            </div>
            <div style="margin-top: 1rem;"><button type="submit" class="btn btn-primary">Salveaza servicii</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     BLOG
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; Sectiune Blog</span>
        <span class="hp-accordion-count"><?= $hp['blog']['count'] ?? 3 ?> articole</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/blog">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="admin-field-row">
                <div class="admin-field" style="flex:1;">
                    <label>Titlu sectiune</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($hp['blog']['title'] ?? '') ?>">
                </div>
                <div class="admin-field" style="flex:2;">
                    <label>Subtitlu</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($hp['blog']['subtitle'] ?? '') ?>">
                </div>
                <div class="admin-field" style="width:120px;">
                    <label>Nr. articole</label>
                    <input type="number" name="count" value="<?= (int)($hp['blog']['count'] ?? 3) ?>" min="1" max="6">
                </div>
            </div>
            <small class="admin-field-hint">Articolele se incarca automat din blog (cele mai recente publicate).</small>
            <div style="margin-top: 1rem;"><button type="submit" class="btn btn-primary">Salveaza blog</button></div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════
     CTA FINAL
     ═══════════════════════════════════════════════════ -->
<div class="hp-accordion-section">
    <div class="hp-accordion-header" onclick="toggleAccordion(this)">
        <span>&#9654; CTA Final</span>
    </div>
    <div class="hp-accordion-body" style="display:none;">
        <form method="post" action="/admin/homepage/salveaza/cta">
            <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
            <div class="admin-field">
                <label>Titlu</label>
                <input type="text" name="title" value="<?= htmlspecialchars($hp['cta']['title'] ?? '') ?>">
            </div>
            <div class="admin-field">
                <label>Text</label>
                <input type="text" name="text" value="<?= htmlspecialchars($hp['cta']['text'] ?? '') ?>">
            </div>
            <div class="admin-field-row">
                <div class="admin-field">
                    <label>Text buton</label>
                    <input type="text" name="button_text" value="<?= htmlspecialchars($hp['cta']['button_text'] ?? '') ?>">
                </div>
                <div class="admin-field">
                    <label>Link buton</label>
                    <input type="text" name="button_link" value="<?= htmlspecialchars($hp['cta']['button_link'] ?? '') ?>">
                </div>
                <div class="admin-field">
                    <label>Telefon</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($hp['cta']['phone'] ?? '') ?>">
                </div>
            </div>
            <div style="margin-top: 1rem;"><button type="submit" class="btn btn-primary">Salveaza CTA</button></div>
        </form>
    </div>
</div>

</div><!-- .hp-manager -->

<script>
// Accordion toggle
function toggleAccordion(header) {
    const body = header.nextElementSibling;
    const arrow = header.querySelector('span:first-child');
    if (body.style.display === 'none') {
        body.style.display = 'block';
        arrow.textContent = arrow.textContent.replace('\u25B6', '\u25BC');
    } else {
        body.style.display = 'none';
        arrow.textContent = arrow.textContent.replace('\u25BC', '\u25B6');
    }
}

// Section order
function moveSection(btn, dir) {
    const item = btn.closest('.hp-order-item');
    const list = item.parentElement;
    if (dir === -1 && item.previousElementSibling) {
        list.insertBefore(item, item.previousElementSibling);
    } else if (dir === 1 && item.nextElementSibling) {
        list.insertBefore(item.nextElementSibling, item);
    }
}

// Generic remove repeater item
function removeRepeaterItem(btn) {
    if (confirm('Sigur doriti sa stergeti acest element?')) {
        btn.closest('.hp-repeater-item, .hp-repeater-compact').remove();
    }
}

// Reindex repeater items after adding
function reindexContainer(container, prefix) {
    container.querySelectorAll('.hp-repeater-item, .hp-repeater-compact').forEach((item, idx) => {
        item.querySelectorAll('input, select, textarea').forEach(inp => {
            if (inp.name) {
                inp.name = inp.name.replace(/\[\d+\]/, '[' + idx + ']');
            }
        });
    });
}

// Add slide
function addSlide() {
    const c = document.getElementById('slidesContainer');
    const idx = c.children.length;
    c.insertAdjacentHTML('beforeend', `
    <div class="hp-repeater-item">
        <div class="hp-repeater-header"><strong>Slide #${idx+1}</strong>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)">\u2715</button></div>
        <input type="hidden" name="slides[${idx}][id]" value="${idx+1}">
        <input type="hidden" name="slides[${idx}][is_active]" value="1">
        <div class="admin-field-row">
            <div class="admin-field" style="flex:2;"><label>Titlu</label><input type="text" name="slides[${idx}][title]"></div>
            <div class="admin-field" style="flex:1;"><label>Imagine (URL)</label><input type="text" name="slides[${idx}][image]" placeholder="/uploads/hero.webp"></div>
        </div>
        <div class="admin-field"><label>Subtitlu</label><input type="text" name="slides[${idx}][subtitle]"></div>
        <div class="admin-field-row">
            <div class="admin-field"><label>Buton 1 text</label><input type="text" name="slides[${idx}][button_text]"></div>
            <div class="admin-field"><label>Buton 1 link</label><input type="text" name="slides[${idx}][button_link]"></div>
        </div>
        <div class="admin-field-row">
            <div class="admin-field"><label>Buton 2 text</label><input type="text" name="slides[${idx}][button2_text]"></div>
            <div class="admin-field"><label>Buton 2 link</label><input type="text" name="slides[${idx}][button2_link]"></div>
        </div>
        <div class="admin-field-row">
            <div class="admin-field"><label>Badge icon</label><input type="text" name="slides[${idx}][badge_icon]"></div>
            <div class="admin-field" style="flex:2;"><label>Badge text</label><input type="text" name="slides[${idx}][badge_text]"></div>
        </div>
    </div>`);
}

// Add category
function addCategory() {
    const c = document.getElementById('categoriesContainer');
    const idx = c.children.length;
    c.insertAdjacentHTML('beforeend', `
    <div class="hp-repeater-item hp-repeater-compact">
        <input type="hidden" name="items[${idx}][id]" value="${idx+1}">
        <input type="hidden" name="items[${idx}][is_active]" value="1">
        <div class="admin-field-row" style="align-items:flex-end;">
            <div class="admin-field" style="width:60px;"><label>Icon</label><input type="text" name="items[${idx}][icon]"></div>
            <div class="admin-field" style="flex:1;"><label>Nume</label><input type="text" name="items[${idx}][name]"></div>
            <div class="admin-field" style="flex:2;"><label>Descriere</label><input type="text" name="items[${idx}][description]"></div>
            <div class="admin-field" style="flex:1;"><label>Link</label><input type="text" name="items[${idx}][link]"></div>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">\u2715</button>
        </div>
    </div>`);
}

// Add brand
function addBrand() {
    const c = document.getElementById('brandsContainer');
    const idx = c.children.length;
    c.insertAdjacentHTML('beforeend', `
    <div class="hp-repeater-item hp-repeater-compact">
        <input type="hidden" name="items[${idx}][id]" value="${idx+1}">
        <input type="hidden" name="items[${idx}][is_active]" value="1">
        <div class="admin-field-row" style="align-items:flex-end;">
            <div class="admin-field" style="flex:1;"><label>Nume brand</label><input type="text" name="items[${idx}][name]"></div>
            <div class="admin-field" style="flex:1;"><label>Link</label><input type="text" name="items[${idx}][link]"></div>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">\u2715</button>
        </div>
    </div>`);
}

// Add banner
function addBanner() {
    const c = document.getElementById('bannersContainer');
    const noMsg = c.querySelector('p');
    if (noMsg) noMsg.remove();
    const idx = c.children.length;
    c.insertAdjacentHTML('beforeend', `
    <div class="hp-repeater-item">
        <div class="hp-repeater-header"><strong>Banner #${idx+1}</strong>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)">\u2715</button></div>
        <input type="hidden" name="items[${idx}][id]" value="${idx+1}">
        <input type="hidden" name="items[${idx}][is_active]" value="1">
        <div class="admin-field-row">
            <div class="admin-field" style="flex:1;"><label>Titlu</label><input type="text" name="items[${idx}][title]"></div>
            <div class="admin-field" style="flex:1;"><label>Imagine (URL)</label><input type="text" name="items[${idx}][image]"></div>
        </div>
        <div class="admin-field-row">
            <div class="admin-field" style="flex:2;"><label>Text</label><input type="text" name="items[${idx}][text]"></div>
            <div class="admin-field" style="flex:1;"><label>Link</label><input type="text" name="items[${idx}][link]"></div>
            <div class="admin-field" style="width:120px;"><label>Pozitie</label>
                <select name="items[${idx}][position]"><option value="top">Sus</option><option value="middle">Mijloc</option><option value="bottom">Jos</option></select>
            </div>
        </div>
    </div>`);
}

// Add feature
function addFeature() {
    const c = document.getElementById('featuresContainer');
    const idx = c.children.length;
    c.insertAdjacentHTML('beforeend', `
    <div class="hp-repeater-item hp-repeater-compact">
        <input type="hidden" name="features[${idx}][id]" value="${idx+1}">
        <input type="hidden" name="features[${idx}][is_active]" value="1">
        <div class="admin-field-row" style="align-items:flex-end;">
            <div class="admin-field" style="width:70px;"><label>Icon</label><input type="text" name="features[${idx}][icon]"></div>
            <div class="admin-field" style="flex:1;"><label>Titlu</label><input type="text" name="features[${idx}][title]"></div>
            <div class="admin-field" style="flex:2;"><label>Text</label><input type="text" name="features[${idx}][text]"></div>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">\u2715</button>
        </div>
    </div>`);
}

// Add service
function addService() {
    const c = document.getElementById('servicesContainer');
    const idx = c.children.length;
    c.insertAdjacentHTML('beforeend', `
    <div class="hp-repeater-item hp-repeater-compact">
        <input type="hidden" name="items[${idx}][id]" value="${idx+1}">
        <input type="hidden" name="items[${idx}][is_active]" value="1">
        <div class="admin-field-row" style="align-items:flex-end;">
            <div class="admin-field" style="width:70px;"><label>Icon</label><input type="text" name="items[${idx}][icon]"></div>
            <div class="admin-field" style="flex:1;"><label>Titlu</label><input type="text" name="items[${idx}][title]"></div>
            <div class="admin-field" style="flex:2;"><label>Text</label><input type="text" name="items[${idx}][text]"></div>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)" style="margin-bottom:0.5rem;">\u2715</button>
        </div>
    </div>`);
}

// Product mode toggle
function toggleProductMode() {
    const mode = document.querySelector('input[name="mode"]:checked').value;
    document.getElementById('productManualFields').style.display = mode === 'manual' ? '' : 'none';
    document.getElementById('productAutoFields').style.display = mode !== 'manual' ? '' : 'none';
}

// Add product slug selector
const allProductsData = <?= json_encode(array_map(fn($p) => ['slug' => $p['slug'], 'name' => $p['name'] ?? $p['slug']], $allProducts)) ?>;
function addProductSlug() {
    const c = document.getElementById('productSlugsContainer');
    let opts = '<option value="">— Selecteaza produs —</option>';
    allProductsData.forEach(p => { opts += `<option value="${p.slug}">${p.name}</option>`; });
    c.insertAdjacentHTML('beforeend', `
    <div class="hp-repeater-compact" style="margin-bottom: 0.5rem; display:flex; gap:0.5rem; align-items:center;">
        <select name="manual_slugs[]" class="admin-filter-select" style="flex:1;">${opts}</select>
        <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">\u2715</button>
    </div>`);
}
</script>
