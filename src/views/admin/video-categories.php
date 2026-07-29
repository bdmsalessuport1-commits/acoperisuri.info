<?php
/** @var array $categories */
/** @var array|null $flash */
$csrfToken = \App\Helpers\Auth::csrfToken();

// Build parent names map
$parentNames = [];
foreach ($categories as $cat) {
    if (($cat['parent_id'] ?? 0) === 0) {
        $parentNames[$cat['id']] = $cat['name'];
    }
}
?>

<?php if ($flash): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<!-- Toolbar -->
<div class="admin-toolbar">
    <div class="admin-toolbar-left">
        <span class="admin-toolbar-count"><?= count($categories) ?> categorii video</span>
        <a href="/admin/videouri" class="btn btn-sm btn-outline" style="margin-left: 0.5rem;">&larr; Inapoi la videouri</a>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/videouri/categorii/adauga" class="btn btn-primary">+ Adauga categorie</a>
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
                    <th>Parinte</th>
                    <th style="width: 70px;">Videouri</th>
                    <th style="width: 60px;">Ordine</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width: 120px;">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr><td colspan="8" style="text-align: center; padding: 2rem;">Nicio categorie video gasita.</td></tr>
                <?php else: ?>
                    <?php foreach ($categories as $cat): ?>
                        <?php $isChild = ($cat['parent_id'] ?? 0) > 0; ?>
                        <tr>
                            <td class="admin-td-id"><?= $cat['id'] ?></td>
                            <td>
                                <?php if ($isChild): ?>
                                    <span style="color: var(--color-text-light); margin-right: 0.25rem;">—</span>
                                <?php endif; ?>
                                <strong<?= !$isChild ? ' style="font-size: 1.05em;"' : '' ?>><?= htmlspecialchars(($cat['icon'] ?? '') . ' ' . ($cat['name'] ?? '')) ?></strong>
                            </td>
                            <td><code class="admin-slug"><?= htmlspecialchars($cat['slug'] ?? '') ?></code></td>
                            <td><?= $isChild ? htmlspecialchars($parentNames[$cat['parent_id']] ?? '-') : '<em style="color:var(--color-text-light);">—</em>' ?></td>
                            <td style="text-align: center;"><?= $cat['video_count'] ?? 0 ?></td>
                            <td style="text-align: center;"><?= $cat['sort_order'] ?? 0 ?></td>
                            <td>
                                <span class="admin-status <?= !empty($cat['is_active']) ? 'admin-status-active' : 'admin-status-draft' ?>"><?= !empty($cat['is_active']) ? 'Activ' : 'Inactiv' ?></span>
                            </td>
                            <td class="admin-td-actions">
                                <a href="/admin/videouri/categorii/editeaza/<?= $cat['id'] ?>" class="btn btn-sm btn-outline" title="Editeaza">&#9998;</a>
                                <form method="post" action="/admin/videouri/categorii/sterge/<?= $cat['id'] ?>" style="display:inline;" title="Sterge">
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
