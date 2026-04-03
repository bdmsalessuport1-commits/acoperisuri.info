<?php
/** @var array $formData */
/** @var array $errors */
/** @var array $categories */
/** @var array $subcategories */
/** @var array $allProducts */
/** @var bool $isEdit */
$csrfToken = \App\Helpers\Auth::csrfToken();
$action = $isEdit ? '/admin/produse/editeaza/' . ($formData['id'] ?? 0) : '/admin/produse/adauga';
?>

<?php if (!empty($errors)): ?>
    <div class="admin-flash admin-flash-error">
        <ul style="margin: 0; padding-left: 1.2rem;">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= $action ?>" class="admin-form-grid" id="productForm" enctype="multipart/form-data">
    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

    <!-- ═══ MAIN COLUMN ═══ -->
    <div class="admin-form-main">

        <!-- Info de baza -->
        <div class="admin-card">
            <div class="admin-card-header">Informatii de baza</div>
            <div class="admin-card-body">
                <div class="admin-field">
                    <label>Nume produs *</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($formData['name'] ?? '') ?>" required
                           oninput="if(!document.getElementById('slugEdited').value) document.getElementById('slugField').value = this.value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g,'').replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,'')">
                </div>
                <div class="admin-field">
                    <label>Subtitlu / Tagline</label>
                    <input type="text" name="subtitle" value="<?= htmlspecialchars($formData['subtitle'] ?? '') ?>" placeholder="Scurta descriere a produsului">
                </div>
                <div class="admin-field">
                    <label>Slug *</label>
                    <div class="admin-input-group">
                        <span class="admin-input-prefix">/produs/</span>
                        <input type="text" name="slug" id="slugField" value="<?= htmlspecialchars($formData['slug'] ?? '') ?>" required
                               oninput="document.getElementById('slugEdited').value='1'">
                        <input type="hidden" id="slugEdited" value="<?= !empty($formData['slug']) ? '1' : '' ?>">
                    </div>
                </div>
                <div class="admin-field-row">
                    <div class="admin-field">
                        <label>Categorie *</label>
                        <select name="category_id" id="categorySelect" required onchange="filterSubcategories()">
                            <option value="">-- Selecteaza --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= ($formData['category_id'] ?? 0) == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="admin-field">
                        <label>Subcategorie *</label>
                        <select name="subcategory_id" id="subcategorySelect" required>
                            <option value="">-- Selecteaza --</option>
                            <?php foreach ($subcategories as $sub): ?>
                                <option value="<?= $sub['id'] ?>" data-cat="<?= $sub['category_id'] ?>" <?= ($formData['subcategory_id'] ?? 0) == $sub['id'] ? 'selected' : '' ?>><?= htmlspecialchars($sub['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="admin-field">
                    <label>Producator / Brand</label>
                    <input type="text" name="manufacturer" value="<?= htmlspecialchars($formData['manufacturer'] ?? '') ?>" placeholder="Ex: Budmat, Metigla, FAKRO">
                </div>
            </div>
        </div>

        <!-- Imagini -->
        <div class="admin-card">
            <div class="admin-card-header">Imagini</div>
            <div class="admin-card-body">
                <div class="admin-field">
                    <label>Imagine principala (1400 x 1000 px)</label>
                    <input type="text" name="image_main" value="<?= htmlspecialchars($formData['image_main'] ?? '') ?>" placeholder="URL imagine principala">
                    <small class="admin-field-hint">Rezolutie recomandata: 1400 x 1000 px</small>
                </div>
                <div class="admin-field">
                    <label>Schema tehnica</label>
                    <input type="text" name="image_schema" value="<?= htmlspecialchars($formData['image_schema'] ?? '') ?>" placeholder="URL schema tehnica">
                </div>
                <div class="admin-field">
                    <label>Galerie (un URL per rand)</label>
                    <textarea name="gallery_urls" rows="4" placeholder="https://example.com/img1.jpg&#10;https://example.com/img2.jpg"><?= htmlspecialchars(implode("\n", $formData['gallery'] ?? [])) ?></textarea>
                </div>
            </div>
        </div>

        <!-- Specificatii tehnice -->
        <div class="admin-card">
            <div class="admin-card-header">
                Specificatii tehnice
                <button type="button" class="btn btn-sm btn-outline" onclick="addSpecRow()" style="margin-left: auto;">+ Adauga</button>
            </div>
            <div class="admin-card-body" id="specsContainer">
                <?php
                $specs = $formData['specs'] ?? [];
                if (empty($specs)) $specs = [['key' => '', 'value' => '']];
                foreach ($specs as $i => $spec):
                ?>
                <div class="admin-dynamic-row" data-type="spec">
                    <input type="text" name="spec_key[]" value="<?= htmlspecialchars($spec['key'] ?? '') ?>" placeholder="Specificatie (ex: Grosime tabla)" class="admin-dynamic-key">
                    <input type="text" name="spec_value[]" value="<?= htmlspecialchars($spec['value'] ?? '') ?>" placeholder="Valoare (ex: 0.50 mm)" class="admin-dynamic-value">
                    <button type="button" class="btn btn-sm btn-danger admin-dynamic-remove" onclick="this.closest('.admin-dynamic-row').remove()" title="Sterge">&times;</button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Categorii finisaje si culori -->
        <div class="admin-card">
            <div class="admin-card-header">
                Categorii finisaje si culori
                <button type="button" class="btn btn-sm btn-outline" onclick="addMaterialGroup()" style="margin-left: auto;">+ Categorie finisaj</button>
            </div>
            <div class="admin-card-body" id="materialsContainer">
                <div class="admin-swatch-hint">
                    <strong>Imagine recomandata:</strong> 200 &times; 200px, format patrat, JPG sau WebP, fundal curat, aceeasi proportie pentru toate imaginile din aceeasi categorie.
                </div>
                <?php
                $materials = $formData['materials'] ?? [];
                foreach ($materials as $mi => $mat):
                ?>
                <div class="admin-material-group" data-mat-index="<?= $mi ?>">
                    <div class="admin-material-header">
                        <input type="text" name="mat_name[<?= $mi ?>]" value="<?= htmlspecialchars($mat['name'] ?? '') ?>" placeholder="Nume categorie finisaj (ex: SuperMat, PUR Nova, Lucios)" class="admin-material-name">
                        <button type="button" class="btn btn-sm btn-outline" onclick="addColorRow(this.closest('.admin-material-group'))" title="Adauga culoare">+ Culoare</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.admin-material-group').remove()" title="Sterge categorie">&times;</button>
                    </div>
                    <div class="admin-colors-list">
                        <?php foreach ($mat['colors'] ?? [] as $ci => $color): ?>
                        <div class="admin-color-row">
                            <div class="admin-color-swatch-wrap">
                                <?php if (!empty($color['swatch'])): ?>
                                    <img src="<?= htmlspecialchars($color['swatch']) ?>" alt="swatch" class="admin-color-swatch-preview">
                                    <input type="hidden" name="mat_colors[<?= $mi ?>][swatch_existing][<?= $ci ?>]" value="<?= htmlspecialchars($color['swatch']) ?>">
                                <?php else: ?>
                                    <div class="admin-color-swatch-placeholder" style="background-color: <?= htmlspecialchars($color['hex'] ?? '#cccccc') ?>;"></div>
                                <?php endif; ?>
                                <input type="file" name="mat_colors_file[<?= $mi ?>][<?= $ci ?>]" accept="image/jpeg,image/png,image/webp" class="admin-color-file-input" onchange="previewSwatch(this)">
                                <label class="admin-color-file-label" title="Incarca imagine culoare">&#128247;</label>
                            </div>
                            <input type="text" name="mat_colors[<?= $mi ?>][name][<?= $ci ?>]" value="<?= htmlspecialchars($color['name'] ?? '') ?>" placeholder="Nume culoare" class="admin-color-name">
                            <input type="text" name="mat_colors[<?= $mi ?>][code][<?= $ci ?>]" value="<?= htmlspecialchars($color['code'] ?? '') ?>" placeholder="Cod RAL" class="admin-color-code">
                            <input type="hidden" name="mat_colors[<?= $mi ?>][hex][<?= $ci ?>]" value="<?= htmlspecialchars($color['hex'] ?? '#cccccc') ?>">
                            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.admin-color-row').remove()" title="Sterge">&times;</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Garantie -->
        <div class="admin-card">
            <div class="admin-card-header">Garantie</div>
            <div class="admin-card-body">
                <div class="admin-field">
                    <textarea name="warranty_text" rows="3" placeholder="Text garantie"><?= htmlspecialchars($formData['warranty_text'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- Descriere HTML -->
        <div class="admin-card">
            <div class="admin-card-header">Descriere (HTML)</div>
            <div class="admin-card-body">
                <div class="admin-field">
                    <textarea name="description_html" rows="12" class="admin-code-editor" placeholder="<h2>Titlu produs</h2><p>Descriere...</p>"><?= htmlspecialchars($formData['description_html'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- SEO -->
        <div class="admin-card">
            <div class="admin-card-header">SEO</div>
            <div class="admin-card-body">
                <div class="admin-field">
                    <label>SEO Title (max 70 caractere)</label>
                    <input type="text" name="seo_title" value="<?= htmlspecialchars($formData['seo_title'] ?? '') ?>" maxlength="70">
                </div>
                <div class="admin-field">
                    <label>SEO Description (max 160 caractere)</label>
                    <textarea name="seo_description" rows="2" maxlength="160"><?= htmlspecialchars($formData['seo_description'] ?? '') ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ SIDEBAR ═══ -->
    <div class="admin-form-side">

        <!-- Publicare -->
        <div class="admin-card">
            <div class="admin-card-header">Publicare</div>
            <div class="admin-card-body">
                <div class="admin-field">
                    <label>Status</label>
                    <select name="status">
                        <option value="activ" <?= ($formData['status'] ?? '') === 'activ' ? 'selected' : '' ?>>Activ</option>
                        <option value="draft" <?= ($formData['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="inactiv" <?= ($formData['status'] ?? '') === 'inactiv' ? 'selected' : '' ?>>Inactiv</option>
                    </select>
                </div>
                <div class="admin-field">
                    <label class="admin-toggle">
                        <input type="checkbox" name="is_active" value="1" <?= ($formData['is_active'] ?? true) ? 'checked' : '' ?>>
                        <span>Vizibil pe site</span>
                    </label>
                </div>
                <div class="admin-field">
                    <label>Ordine sortare</label>
                    <input type="number" name="sort_order" value="<?= (int) ($formData['sort_order'] ?? 0) ?>" min="0">
                </div>
                <?php if ($isEdit && !empty($formData['created_at'])): ?>
                    <div class="admin-meta">
                        <small>Creat: <?= htmlspecialchars($formData['created_at']) ?></small><br>
                        <small>Modificat: <?= htmlspecialchars($formData['updated_at'] ?? '-') ?></small>
                    </div>
                <?php endif; ?>
            </div>
            <div class="admin-card-footer">
                <button type="submit" class="btn btn-primary btn-block"><?= $isEdit ? 'Salveaza modificarile' : 'Creeaza produsul' ?></button>
            </div>
        </div>

        <!-- Produse relationate -->
        <div class="admin-card">
            <div class="admin-card-header">Produse relationate</div>
            <div class="admin-card-body">
                <div class="admin-field">
                    <div class="admin-related-list" id="relatedList">
                        <?php
                        $relatedSlugs = $formData['related_products'] ?? [];
                        foreach ($relatedSlugs as $rSlug):
                            $rName = $rSlug;
                            foreach ($allProducts as $ap) {
                                if (($ap['slug'] ?? '') === $rSlug) { $rName = $ap['name']; break; }
                            }
                        ?>
                        <div class="admin-related-item">
                            <input type="hidden" name="related_products[]" value="<?= htmlspecialchars($rSlug) ?>">
                            <span><?= htmlspecialchars($rName) ?></span>
                            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.admin-related-item').remove()">&times;</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <select id="addRelatedSelect" onchange="addRelatedProduct(this)">
                        <option value="">+ Adauga produs...</option>
                        <?php foreach ($allProducts as $ap): ?>
                            <?php if (($ap['slug'] ?? '') !== ($formData['slug'] ?? '')): ?>
                                <option value="<?= htmlspecialchars($ap['slug']) ?>"><?= htmlspecialchars($ap['name']) ?> (<?= htmlspecialchars($ap['manufacturer'] ?? '') ?>)</option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <?php $slugPrefix = '/produs/'; \App\Helpers\View::partial('admin-seo-preview', ['formData' => $formData, 'slugPrefix' => $slugPrefix]); ?>

        <!-- Link-uri rapide -->
        <?php if ($isEdit): ?>
        <div class="admin-card">
            <div class="admin-card-header">Actiuni</div>
            <div class="admin-card-body">
                <a href="/produs/<?= htmlspecialchars($formData['slug'] ?? '') ?>" class="btn btn-sm btn-block btn-outline" target="_blank" style="margin-bottom: 0.5rem;">&#8599; Vezi pe site</a>
                <form method="post" action="/admin/produse/duplica/<?= $formData['id'] ?? 0 ?>" style="margin-bottom: 0.5rem;">
                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                    <button type="submit" class="btn btn-sm btn-block btn-outline" onclick="return confirm('Duplica acest produs?')">&#9851; Duplica produsul</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
</form>

<script>
function filterSubcategories() {
    const catId = document.getElementById('categorySelect').value;
    const subSelect = document.getElementById('subcategorySelect');
    const options = subSelect.querySelectorAll('option[data-cat]');
    let hasSelected = false;
    options.forEach(opt => {
        if (!catId || opt.dataset.cat === catId) {
            opt.style.display = '';
            if (opt.selected) hasSelected = true;
        } else {
            opt.style.display = 'none';
            if (opt.selected) { opt.selected = false; }
        }
    });
    if (!hasSelected) subSelect.value = '';
}

function addSpecRow() {
    const container = document.getElementById('specsContainer');
    const row = document.createElement('div');
    row.className = 'admin-dynamic-row';
    row.dataset.type = 'spec';
    row.innerHTML = `
        <input type="text" name="spec_key[]" placeholder="Specificatie" class="admin-dynamic-key">
        <input type="text" name="spec_value[]" placeholder="Valoare" class="admin-dynamic-value">
        <button type="button" class="btn btn-sm btn-danger admin-dynamic-remove" onclick="this.closest('.admin-dynamic-row').remove()">&times;</button>
    `;
    container.appendChild(row);
    row.querySelector('.admin-dynamic-key').focus();
}

let matCounter = <?= count($formData['materials'] ?? []) ?>;
function addMaterialGroup() {
    const container = document.getElementById('materialsContainer');
    const mi = matCounter++;
    const group = document.createElement('div');
    group.className = 'admin-material-group';
    group.dataset.matIndex = mi;
    group.innerHTML = `
        <div class="admin-material-header">
            <input type="text" name="mat_name[${mi}]" placeholder="Nume categorie finisaj (ex: SuperMat, PUR Nova, Lucios)" class="admin-material-name">
            <button type="button" class="btn btn-sm btn-outline" onclick="addColorRow(this.closest('.admin-material-group'))">+ Culoare</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.admin-material-group').remove()">&times;</button>
        </div>
        <div class="admin-colors-list"></div>
    `;
    container.appendChild(group);
    group.querySelector('.admin-material-name').focus();
    addColorRow(group);
}

function addColorRow(groupEl) {
    const mi = groupEl.dataset.matIndex;
    const list = groupEl.querySelector('.admin-colors-list');
    const ci = list.children.length;
    const row = document.createElement('div');
    row.className = 'admin-color-row';
    row.innerHTML = `
        <div class="admin-color-swatch-wrap">
            <div class="admin-color-swatch-placeholder" style="background-color: #cccccc;"></div>
            <input type="file" name="mat_colors_file[${mi}][${ci}]" accept="image/jpeg,image/png,image/webp" class="admin-color-file-input" onchange="previewSwatch(this)">
            <label class="admin-color-file-label" title="Incarca imagine culoare">&#128247;</label>
        </div>
        <input type="text" name="mat_colors[${mi}][name][${ci}]" placeholder="Nume culoare" class="admin-color-name">
        <input type="text" name="mat_colors[${mi}][code][${ci}]" placeholder="Cod RAL" class="admin-color-code">
        <input type="hidden" name="mat_colors[${mi}][hex][${ci}]" value="#cccccc">
        <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.admin-color-row').remove()">&times;</button>
    `;
    list.appendChild(row);
    row.querySelector('.admin-color-name').focus();
}

function previewSwatch(input) {
    if (!input.files || !input.files[0]) return;
    const wrap = input.closest('.admin-color-swatch-wrap');
    const reader = new FileReader();
    reader.onload = function(e) {
        // Replace placeholder or existing preview with new image
        const existing = wrap.querySelector('.admin-color-swatch-preview, .admin-color-swatch-placeholder');
        if (existing) existing.remove();
        const img = document.createElement('img');
        img.src = e.target.result;
        img.alt = 'swatch preview';
        img.className = 'admin-color-swatch-preview';
        wrap.insertBefore(img, wrap.firstChild);
    };
    reader.readAsDataURL(input.files[0]);
}

function addRelatedProduct(selectEl) {
    const slug = selectEl.value;
    if (!slug) return;
    const name = selectEl.options[selectEl.selectedIndex].text;
    const list = document.getElementById('relatedList');

    // Check if already added
    const existing = list.querySelectorAll('input[name="related_products[]"]');
    for (const inp of existing) {
        if (inp.value === slug) { selectEl.value = ''; return; }
    }

    const item = document.createElement('div');
    item.className = 'admin-related-item';
    item.innerHTML = `
        <input type="hidden" name="related_products[]" value="${slug}">
        <span>${name}</span>
        <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.admin-related-item').remove()">&times;</button>
    `;
    list.appendChild(item);
    selectEl.value = '';
}

// Init subcategory filter
filterSubcategories();
</script>
