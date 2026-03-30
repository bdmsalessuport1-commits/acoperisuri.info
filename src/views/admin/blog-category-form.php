<?php
/** @var array $formData */
/** @var array $errors */
/** @var bool $isEdit */
$csrfToken = \App\Helpers\Auth::csrfToken();
$action = $isEdit ? '/admin/blog/categorii/editeaza/' . ($formData['id'] ?? 0) : '/admin/blog/categorii/adauga';
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

<div style="margin-bottom: 1rem;">
    <a href="/admin/blog/categorii" class="btn btn-sm btn-outline">&larr; Inapoi la categorii</a>
</div>

<form method="post" action="<?= $action ?>">
    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

    <div class="admin-form-grid">
        <div class="admin-form-main">
            <div class="admin-card">
                <div class="admin-card-header">Categorie blog</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>Nume *</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($formData['name'] ?? '') ?>" required id="catNameInput">
                    </div>
                    <div class="admin-field">
                        <label>Slug *</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="text" name="slug" value="<?= htmlspecialchars($formData['slug'] ?? '') ?>" required id="catSlugInput" style="flex: 1;">
                            <button type="button" class="btn btn-sm btn-outline" onclick="generateCatSlug()">Auto</button>
                        </div>
                    </div>
                    <div class="admin-field">
                        <label>Descriere</label>
                        <textarea name="description" rows="3"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field">
                            <label>Icon (HTML entity)</label>
                            <input type="text" name="icon" value="<?= htmlspecialchars($formData['icon'] ?? '') ?>" placeholder="&#128295;">
                        </div>
                        <div class="admin-field">
                            <label>Ordine sortare</label>
                            <input type="number" name="sort_order" value="<?= (int)($formData['sort_order'] ?? 0) ?>" min="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-form-side">
            <div class="admin-card">
                <div class="admin-card-header">Salveaza</div>
                <div class="admin-card-body">
                    <button type="submit" class="btn btn-primary btn-block"><?= $isEdit ? 'Actualizeaza' : 'Salveaza' ?></button>
                    <?php if ($isEdit): ?>
                        <a href="/blog/categorie/<?= htmlspecialchars($formData['slug'] ?? '') ?>" class="btn btn-sm btn-outline btn-block" target="_blank" style="margin-top: 0.5rem;">&#8599; Vezi pe site</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function generateCatSlug() {
    const name = document.getElementById('catNameInput').value;
    const slug = name.toLowerCase()
        .replace(/[ăâ]/g, 'a').replace(/[îi]/g, 'i').replace(/[ș]/g, 's').replace(/[ț]/g, 't')
        .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
    document.getElementById('catSlugInput').value = slug;
}
</script>
