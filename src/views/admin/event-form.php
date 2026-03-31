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
                <h3>Detalii eveniment</h3>
            </div>
            <div class="admin-card-body">
                <div class="form-group">
                    <label for="title">Titlu *</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($formData['title'] ?? '') ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug *</label>
                    <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($formData['slug'] ?? '') ?>" class="form-control" required>
                </div>

                <div class="form-row">
                    <div class="form-group" style="flex: 1;">
                        <label for="location">Locatie</label>
                        <input type="text" id="location" name="location" value="<?= htmlspecialchars($formData['location'] ?? '') ?>" class="form-control" placeholder="ex: Bucuresti, Showroom BDM">
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label for="event_date">Data eveniment *</label>
                        <input type="date" id="event_date" name="event_date" value="<?= htmlspecialchars($formData['event_date'] ?? '') ?>" class="form-control" required>
                    </div>
                    <div class="form-group" style="width: 140px;">
                        <label for="event_time">Ora</label>
                        <input type="time" id="event_time" name="event_time" value="<?= htmlspecialchars($formData['event_time'] ?? '') ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Descriere scurta</label>
                    <textarea id="description" name="description" class="form-control" rows="3" placeholder="Descriere scurta pentru listing"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Imagine (URL)</label>
                    <input type="text" id="image" name="image" value="<?= htmlspecialchars($formData['image'] ?? '') ?>" class="form-control" placeholder="/images/events/...">
                    <?php if (!empty($formData['image'])): ?>
                        <img src="<?= htmlspecialchars($formData['image']) ?>" alt="Preview" style="max-width: 200px; margin-top: 0.5rem; border-radius: 4px;">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="content">Continut (HTML)</label>
                    <textarea id="content" name="content" class="form-control" rows="12"><?= htmlspecialchars($formData['content'] ?? '') ?></textarea>
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
                        <option value="draft" <?= ($formData['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="publicat" <?= ($formData['status'] ?? '') === 'publicat' ? 'selected' : '' ?>>Publicat</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sort_order">Ordine sortare</label>
                    <input type="number" id="sort_order" name="sort_order" value="<?= (int)($formData['sort_order'] ?? 0) ?>" class="form-control" min="0">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <?= $isEdit ? 'Salveaza modificarile' : 'Creeaza eveniment' ?>
                    </button>
                    <a href="/admin/evenimente" class="btn btn-outline" style="width: 100%; margin-top: 0.5rem; text-align: center;">Anuleaza</a>
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
