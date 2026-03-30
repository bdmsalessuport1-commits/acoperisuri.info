<?php
/** @var array $categories */
/** @var array|null $flash */
$csrfToken = \App\Helpers\Auth::csrfToken();
?>

<?php if ($flash): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<!-- Toolbar -->
<div class="admin-toolbar">
    <div class="admin-toolbar-left">
        <span class="admin-toolbar-count"><?= count($categories) ?> categorii blog</span>
        <a href="/admin/blog" class="btn btn-sm btn-outline" style="margin-left: 0.5rem;">&larr; Inapoi la articole</a>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/blog/categorii/adauga" class="btn btn-primary">+ Adauga categorie</a>
    </div>
</div>

<!-- Categories Table -->
<div class="admin-card">
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Nume</th>
                    <th>Slug</th>
                    <th>Descriere</th>
                    <th style="width: 60px;">Ordine</th>
                    <th style="width: 140px;">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr><td colspan="6" style="text-align: center; padding: 2rem;">Nicio categorie blog gasita.</td></tr>
                <?php else: ?>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td class="admin-td-id"><?= $cat['id'] ?></td>
                            <td>
                                <strong><?= htmlspecialchars($cat['icon'] ?? '') ?> <?= htmlspecialchars($cat['name'] ?? '') ?></strong>
                            </td>
                            <td><code class="admin-slug"><?= htmlspecialchars($cat['slug'] ?? '') ?></code></td>
                            <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= htmlspecialchars($cat['description'] ?? '-') ?></td>
                            <td style="text-align: center;"><?= $cat['sort_order'] ?? 0 ?></td>
                            <td class="admin-td-actions">
                                <a href="/blog/categorie/<?= htmlspecialchars($cat['slug'] ?? '') ?>" class="btn btn-sm" target="_blank" title="Vezi pe site">&#8599;</a>
                                <a href="/admin/blog/categorii/editeaza/<?= $cat['id'] ?>" class="btn btn-sm btn-outline" title="Editeaza">&#9998;</a>
                                <form method="post" action="/admin/blog/categorii/sterge/<?= $cat['id'] ?>" style="display:inline;" title="Sterge">
                                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sigur stergi categoria &quot;<?= htmlspecialchars($cat['name'] ?? '') ?>&quot;?')">&#10005;</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
