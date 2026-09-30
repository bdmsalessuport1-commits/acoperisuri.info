<?php use App\Helpers\Auth; ?>

<div class="admin-toolbar">
    <div class="admin-toolbar-left">
        <a href="/admin/categorii" class="btn btn-sm btn-outline">&larr; Inapoi la categorii</a>
    </div>
</div>

<?php if (!empty($errors)): ?>
    <div class="admin-flash admin-flash-error">
        <strong>Erori:</strong>
        <ul style="margin: 4px 0 0 16px;">
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" class="admin-form" novalidate>
    <?= Auth::csrfField() ?>

    <div class="admin-form-grid">
        <!-- Coloana principala -->
        <div class="admin-form-main">
            <div class="admin-card">
                <div class="admin-card-header">Informatii categorie</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label for="name">Nume categorie <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($formData['name'] ?? '') ?>" required>
                    </div>

                    <div class="admin-field">
                        <label for="slug">Slug (URL) <span class="required">*</span></label>
                        <div class="admin-input-group">
                            <span class="admin-input-prefix">/</span>
                            <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($formData['slug'] ?? '') ?>" required>
                        </div>
                        <small class="admin-field-hint">Se genereaza automat din nume. Modificati doar daca stiti ce faceti.</small>
                    </div>

                    <div class="admin-field">
                        <label for="description">Descriere scurta</label>
                        <textarea id="description" name="description" rows="3"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
                    </div>

                    <div class="admin-field">
                        <label for="icon">Icon (HTML entity)</label>
                        <input type="text" id="icon" name="icon" value="<?= htmlspecialchars($formData['icon'] ?? '') ?>" placeholder="&#9650;">
                        <small class="admin-field-hint">Exemplu: &amp;#9650; pentru &#9650;</small>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">Imagine categorie</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label for="image">URL imagine</label>
                        <input type="text" id="image" name="image" value="<?= htmlspecialchars($formData['image'] ?? '') ?>" placeholder="/images/categories/tigla-metalica.png">
                        <small class="admin-field-hint">Dimensiune recomandata: 800 x 800 px, format PNG sau WebP, imagine patrata, fundal uniform, produs centrat.</small>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">SEO</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label for="seo_title">Meta Title</label>
                        <input type="text" id="seo_title" name="seo_title" value="<?= htmlspecialchars($formData['seo_title'] ?? '') ?>" maxlength="70">
                        <small class="admin-field-hint">Max 70 caractere. Lasat gol = se genereaza din numele categoriei.</small>
                    </div>

                    <div class="admin-field">
                        <label for="seo_description">Meta Description</label>
                        <textarea id="seo_description" name="seo_description" rows="2" maxlength="160"><?= htmlspecialchars($formData['seo_description'] ?? '') ?></textarea>
                        <small class="admin-field-hint">Max 160 caractere.</small>
                    </div>

                    <div class="admin-field">
                        <label for="seo_text">Text SEO (HTML)</label>
                        <textarea id="seo_text" name="seo_text" rows="10" class="admin-code-editor"><?= htmlspecialchars($formData['seo_text'] ?? '') ?></textarea>
                        <small class="admin-field-hint">HTML permis: h2, h3, p, ul, li, strong, em, a. Acest text apare in partea de jos a paginii de categorie.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="admin-form-side">
            <div class="admin-card">
                <div class="admin-card-header">Publicare</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label class="admin-toggle">
                            <input type="checkbox" name="is_active" value="1" <?= ($formData['is_active'] ?? true) ? 'checked' : '' ?>>
                            <span>Categorie activa</span>
                        </label>
                    </div>

                    <div class="admin-field">
                        <label for="sort_order">Ordine afisare</label>
                        <input type="number" id="sort_order" name="sort_order" value="<?= (int)($formData['sort_order'] ?? 0) ?>" min="0">
                    </div>

                    <?php if (!empty($formData['created_at'])): ?>
                        <div class="admin-meta">
                            <span>Creat: <?= date('d.m.Y H:i', strtotime($formData['created_at'])) ?></span>
                            <span>Modificat: <?= date('d.m.Y H:i', strtotime($formData['updated_at'] ?? $formData['created_at'])) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="admin-card-footer">
                    <button type="submit" class="btn btn-primary btn-block"><?= $isEdit ? 'Salveaza modificarile' : 'Creeaza categorie' ?></button>
                </div>
            </div>

            <?php $slugPrefix = '/'; \App\Helpers\View::partial('admin-seo-preview', ['formData' => $formData, 'slugPrefix' => $slugPrefix]); ?>
        </div>
    </div>
</form>

<script>
// Auto-generare slug din nume
(function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    let slugManuallyEdited = <?= !empty($formData['slug']) ? 'true' : 'false' ?>;

    slugInput.addEventListener('input', () => { slugManuallyEdited = true; });

    nameInput.addEventListener('input', () => {
        if (slugManuallyEdited) return;
        let slug = nameInput.value.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[ăâ]/g, 'a').replace(/[îți]/g, 'i').replace(/[ș]/g, 's').replace(/[ț]/g, 't')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.value = slug;
    });
})();
</script>
