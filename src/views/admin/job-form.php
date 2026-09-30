<?php
/** @var array $formData */
/** @var array $errors */
/** @var bool $isEdit */
$csrfToken = \App\Helpers\Auth::csrfToken();
?>

<?php if (!empty($errors)): ?>
    <div class="admin-flash admin-flash-error">
        <ul style="margin: 0; padding-left: 1.25rem;">
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="" class="admin-form-layout">
    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

    <div class="admin-form-main">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3>Detalii job</h3>
            </div>
            <div class="admin-card-body">
                <div class="form-group">
                    <label for="title">Titlu pozitie *</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($formData['title'] ?? '') ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug *</label>
                    <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($formData['slug'] ?? '') ?>" class="form-control" required>
                </div>

                <div class="form-row">
                    <div class="form-group" style="flex: 1;">
                        <label for="location">Locatie</label>
                        <input type="text" id="location" name="location" value="<?= htmlspecialchars($formData['location'] ?? '') ?>" class="form-control" placeholder="ex: Bucuresti">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="type">Tip program</label>
                        <select id="type" name="type" class="form-control">
                            <option value="Full-time" <?= ($formData['type'] ?? '') === 'Full-time' ? 'selected' : '' ?>>Full-time</option>
                            <option value="Part-time" <?= ($formData['type'] ?? '') === 'Part-time' ? 'selected' : '' ?>>Part-time</option>
                            <option value="Remote" <?= ($formData['type'] ?? '') === 'Remote' ? 'selected' : '' ?>>Remote</option>
                            <option value="Proiect" <?= ($formData['type'] ?? '') === 'Proiect' ? 'selected' : '' ?>>Proiect</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Descriere *</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required placeholder="Descriere scurta a pozitiei"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="responsibilities">Responsabilitati</label>
                    <textarea id="responsibilities" name="responsibilities" class="form-control" rows="6" placeholder="O responsabilitate pe linie"><?= htmlspecialchars($formData['responsibilities'] ?? '') ?></textarea>
                    <small style="color: var(--color-text-light);">Scrieti fiecare responsabilitate pe o linie noua</small>
                </div>

                <div class="form-group">
                    <label for="requirements">Cerinte</label>
                    <textarea id="requirements" name="requirements" class="form-control" rows="6" placeholder="O cerinta pe linie"><?= htmlspecialchars($formData['requirements'] ?? '') ?></textarea>
                    <small style="color: var(--color-text-light);">Scrieti fiecare cerinta pe o linie noua</small>
                </div>

                <div class="form-group">
                    <label for="benefits">Beneficii</label>
                    <textarea id="benefits" name="benefits" class="form-control" rows="5" placeholder="Un beneficiu pe linie"><?= htmlspecialchars($formData['benefits'] ?? '') ?></textarea>
                    <small style="color: var(--color-text-light);">Scrieti fiecare beneficiu pe o linie noua</small>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-form-sidebar">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3>Publicare</h3>
            </div>
            <div class="admin-card-body">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="activ" <?= ($formData['status'] ?? 'activ') === 'activ' ? 'selected' : '' ?>>Activ</option>
                        <option value="inactiv" <?= ($formData['status'] ?? '') === 'inactiv' ? 'selected' : '' ?>>Inactiv</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_posted">Data publicare</label>
                    <input type="date" id="date_posted" name="date_posted" value="<?= htmlspecialchars($formData['date_posted'] ?? date('Y-m-d')) ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="sort_order">Ordine sortare</label>
                    <input type="number" id="sort_order" name="sort_order" value="<?= (int)($formData['sort_order'] ?? 0) ?>" class="form-control" min="0">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <?= $isEdit ? 'Salveaza modificarile' : 'Creeaza job' ?>
                    </button>
                    <a href="/admin/cariere" class="btn btn-outline" style="width: 100%; margin-top: 0.5rem; text-align: center;">Anuleaza</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
(function(){
    var title = document.getElementById('title');
    var slug = document.getElementById('slug');
    var autoSlug = <?= $isEdit ? 'false' : 'true' ?>;

    if (slug.value !== '') autoSlug = false;

    slug.addEventListener('input', function(){ autoSlug = false; });

    title.addEventListener('input', function(){
        if (!autoSlug) return;
        slug.value = this.value
            .toLowerCase()
            .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e').replace(/[ìíîï]/g, 'i')
            .replace(/[òóôõö]/g, 'o').replace(/[ùúûü]/g, 'u')
            .replace(/[șş]/g, 's').replace(/[țţ]/g, 't').replace(/[ăâ]/g, 'a').replace(/î/g, 'i')
            .replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    });
})();
</script>
