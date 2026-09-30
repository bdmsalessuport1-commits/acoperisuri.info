<?php
/** @var array $formData */
/** @var array $errors */
/** @var array $allCategories */
/** @var bool $isEdit */
$csrfToken = \App\Helpers\Auth::csrfToken();
$action = $isEdit ? '/admin/videouri/editeaza/' . ($formData['id'] ?? 0) : '/admin/videouri/adauga';

// Build parent/subcategory arrays for JS
$parentCats = array_values(array_filter($allCategories, fn($c) => ($c['parent_id'] ?? 0) === 0));
$subCats = array_values(array_filter($allCategories, fn($c) => ($c['parent_id'] ?? 0) > 0));
?>

<?php if (!empty($errors)): ?>
    <div class="admin-flash admin-flash-error">
        <ul style="margin: 0; padding-left: 1.25rem;">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= $action ?>" id="videoForm">
    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

    <div class="admin-form-grid">
        <!-- MAIN COLUMN -->
        <div class="admin-form-main">

            <!-- Basic Info -->
            <div class="admin-card">
                <div class="admin-card-header">Informatii video</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>Titlu *</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($formData['title'] ?? '') ?>" required id="titleInput">
                    </div>
                    <div class="admin-field">
                        <label>Slug *</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="text" name="slug" value="<?= htmlspecialchars($formData['slug'] ?? '') ?>" required id="slugInput" style="flex: 1;">
                            <button type="button" class="btn btn-sm btn-outline" onclick="generateSlug()">Auto</button>
                        </div>
                    </div>
                    <div class="admin-field">
                        <label>URL TikTok *</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="url" name="tiktok_url" value="<?= htmlspecialchars($formData['tiktok_url'] ?? '') ?>" placeholder="https://www.tiktok.com/@bdmsystems/video/123456789" required id="tiktokUrlInput" style="flex: 1;">
                            <button type="button" class="btn btn-sm btn-outline" onclick="extractTiktok()">Extrage</button>
                        </div>
                        <small class="admin-field-hint">Lipiti URL-ul TikTok. ID-ul se extrage automat.</small>
                    </div>
                    <div class="admin-field">
                        <label>TikTok ID</label>
                        <input type="text" name="tiktok_id" value="<?= htmlspecialchars($formData['tiktok_id'] ?? '') ?>" id="tiktokIdInput" readonly style="background: #f1f5f9;">
                    </div>
                    <div class="admin-field">
                        <label>Descriere scurta</label>
                        <textarea name="description" rows="3" maxlength="200" id="descInput"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
                        <div class="video-char-counter" id="charCounter"><span id="charCount"><?= mb_strlen($formData['description'] ?? '') ?></span>/200</div>
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field">
                            <label>Categorie *</label>
                            <select name="category_id" id="categorySelect" required>
                                <option value="">— Selecteaza —</option>
                                <?php foreach ($parentCats as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($formData['category_id'] ?? 0) == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="admin-field">
                            <label>Subcategorie *</label>
                            <select name="subcategory_id" id="subcategorySelect" required>
                                <option value="">— Selecteaza categorie —</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thumbnail -->
            <div class="admin-card">
                <div class="admin-card-header">Thumbnail</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>URL thumbnail (optional)</label>
                        <input type="text" name="thumbnail" value="<?= htmlspecialchars($formData['thumbnail'] ?? '') ?>" placeholder="/uploads/video-thumb.webp" id="thumbInput">
                        <small class="admin-field-hint">Daca e gol, se afiseaza un placeholder cu icon play.</small>
                    </div>
                    <?php if (!empty($formData['thumbnail'])): ?>
                        <img src="<?= htmlspecialchars($formData['thumbnail']) ?>" alt="Thumbnail" style="max-width: 200px; border-radius: 4px; margin-top: 0.5rem;">
                    <?php endif; ?>
                </div>
            </div>

            <!-- TikTok Preview -->
            <div class="admin-card">
                <div class="admin-card-header">Preview TikTok</div>
                <div class="admin-card-body">
                    <div class="video-embed-preview" id="tiktokPreview">
                        <?php if (!empty($formData['tiktok_id'])): ?>
                            <blockquote class="tiktok-embed" cite="<?= htmlspecialchars($formData['tiktok_url'] ?? '') ?>" data-video-id="<?= htmlspecialchars($formData['tiktok_id']) ?>" style="max-width: 325px;">
                                <section><a target="_blank" href="<?= htmlspecialchars($formData['tiktok_url'] ?? '') ?>">&#9654; Vezi pe TikTok</a></section>
                            </blockquote>
                        <?php else: ?>
                            <p style="text-align: center; color: var(--color-text-light); padding: 2rem;">Lipiti un URL TikTok si apasati "Extrage" pentru preview.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="admin-form-side">

            <!-- Publish -->
            <div class="admin-card">
                <div class="admin-card-header">Publicare</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label><input type="checkbox" name="is_active" value="1" <?= !empty($formData['is_active']) ? 'checked' : '' ?>> Activ</label>
                    </div>
                    <div class="admin-field">
                        <label>Data publicare</label>
                        <input type="date" name="published_at" value="<?= htmlspecialchars($formData['published_at'] ?? date('Y-m-d')) ?>">
                    </div>
                    <div class="admin-field">
                        <label>Ordine sortare</label>
                        <input type="number" name="sort_order" value="<?= (int)($formData['sort_order'] ?? 0) ?>" min="0">
                    </div>
                    <?php if ($isEdit && !empty($formData['created_at'])): ?>
                        <div style="font-size: var(--text-xs); color: var(--color-text-light); margin-top: 0.5rem;">
                            Creat: <?= htmlspecialchars($formData['created_at'] ?? '') ?><br>
                            Modificat: <?= htmlspecialchars($formData['updated_at'] ?? '') ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;"><?= $isEdit ? 'Actualizeaza videoul' : 'Salveaza videoul' ?></button>
                </div>
            </div>

            <!-- Quick Actions -->
            <?php if ($isEdit && !empty($formData['tiktok_url'])): ?>
            <div class="admin-card">
                <div class="admin-card-header">Actiuni</div>
                <div class="admin-card-body">
                    <a href="<?= htmlspecialchars($formData['tiktok_url']) ?>" class="btn btn-sm btn-outline btn-block" target="_blank">&#8599; Vezi pe TikTok</a>
                    <a href="/video" class="btn btn-sm btn-outline btn-block" target="_blank">&#8599; Pagina videouri</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</form>

<script>
// Subcategories data from PHP
const allSubcategories = <?= json_encode(array_map(fn($s) => ['id' => $s['id'], 'name' => $s['name'], 'parent_id' => $s['parent_id']], $subCats)) ?>;
const initialSubcategoryId = <?= (int)($formData['subcategory_id'] ?? 0) ?>;

// Slug auto-generation
function generateSlug() {
    const title = document.getElementById('titleInput').value;
    document.getElementById('slugInput').value = title.toLowerCase()
        .replace(/[ăâ]/g, 'a').replace(/[îi]/g, 'i').replace(/[ș]/g, 's').replace(/[ț]/g, 't')
        .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
}

// TikTok URL extraction
function extractTiktok() {
    const url = document.getElementById('tiktokUrlInput').value;
    const match = url.match(/video\/(\d+)/);
    if (match) {
        document.getElementById('tiktokIdInput').value = match[1];
        loadTiktokPreview(url, match[1]);
    } else {
        alert('Nu am putut extrage ID-ul TikTok din URL. Verificati formatul.');
    }
}

// Auto-extract on paste
document.getElementById('tiktokUrlInput').addEventListener('paste', function() {
    setTimeout(() => extractTiktok(), 100);
});

// TikTok preview
function loadTiktokPreview(url, id) {
    const preview = document.getElementById('tiktokPreview');
    preview.innerHTML = '<blockquote class="tiktok-embed" cite="' + url + '" data-video-id="' + id + '" style="max-width:325px;"><section><a target="_blank" href="' + url + '">&#9654; Vezi pe TikTok</a></section></blockquote>';
    // Load/reload TikTok SDK
    const existing = document.getElementById('tiktok-sdk');
    if (existing) existing.remove();
    const script = document.createElement('script');
    script.id = 'tiktok-sdk';
    script.src = 'https://www.tiktok.com/embed.js';
    script.async = true;
    document.body.appendChild(script);
}

// Dependent subcategory dropdown
const catSelect = document.getElementById('categorySelect');
const subSelect = document.getElementById('subcategorySelect');

function updateSubcategories(selectedCatId, preselectSubId) {
    subSelect.innerHTML = '<option value="">— Selecteaza —</option>';
    const filtered = allSubcategories.filter(s => s.parent_id === selectedCatId);
    filtered.forEach(s => {
        const opt = document.createElement('option');
        opt.value = s.id;
        opt.textContent = s.name;
        if (s.id === preselectSubId) opt.selected = true;
        subSelect.appendChild(opt);
    });
}

catSelect.addEventListener('change', function() {
    updateSubcategories(parseInt(this.value) || 0, 0);
});

// Initialize on load
if (catSelect.value) {
    updateSubcategories(parseInt(catSelect.value), initialSubcategoryId);
}

// Description char counter
const descInput = document.getElementById('descInput');
const charCount = document.getElementById('charCount');
const charCounter = document.getElementById('charCounter');
descInput.addEventListener('input', function() {
    const len = this.value.length;
    charCount.textContent = len;
    charCounter.classList.toggle('over', len > 200);
});

// Load TikTok SDK if preview exists on page load
<?php if (!empty($formData['tiktok_id'])): ?>
(function() {
    const script = document.createElement('script');
    script.src = 'https://www.tiktok.com/embed.js';
    script.async = true;
    document.body.appendChild(script);
})();
<?php endif; ?>
</script>
