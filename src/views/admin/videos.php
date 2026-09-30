<?php
/** @var array $videos */
/** @var array $categories */
/** @var array $categoryNames */
/** @var int $filterCategory */
/** @var string $filterStatus */
/** @var string $search */
/** @var int $page */
/** @var int $totalPages */
/** @var int $total */
/** @var array|null $flash */
$csrfToken = \App\Helpers\Auth::csrfToken();
?>

<?php if ($flash): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<!-- Toolbar -->
<div class="admin-toolbar">
    <div class="admin-toolbar-left">
        <span class="admin-toolbar-count"><?= $total ?> videouri</span>
        <a href="/admin/videouri/categorii" class="btn btn-sm btn-outline" style="margin-left: 0.5rem;">Categorii video</a>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/videouri/adauga" class="btn btn-primary">+ Adauga video</a>
    </div>
</div>

<!-- Filters -->
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <div class="admin-card-body" style="padding: 1rem 1.25rem;">
        <form method="get" action="/admin/videouri" class="admin-filters-row">
            <div class="admin-filter-group">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cauta video..." class="admin-filter-input">
            </div>
            <div class="admin-filter-group">
                <select name="categorie" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="">Toate categoriile</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $filterCategory === $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="admin-filter-group">
                <select name="status" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="">Toate statusurile</option>
                    <option value="activ" <?= $filterStatus === 'activ' ? 'selected' : '' ?>>Activ</option>
                    <option value="inactiv" <?= $filterStatus === 'inactiv' ? 'selected' : '' ?>>Inactiv</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-outline">Filtreaza</button>
            <?php if ($search || $filterCategory || $filterStatus): ?>
                <a href="/admin/videouri" class="btn btn-sm" style="margin-left: 0.25rem;">Reseteaza</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Videos Table -->
<div class="admin-card">
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Video</th>
                    <th>Categorie</th>
                    <th>Subcategorie</th>
                    <th style="width: 110px;">Data</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width: 120px;">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($videos)): ?>
                    <tr><td colspan="7" style="text-align: center; padding: 2rem;">Niciun video gasit.</td></tr>
                <?php else: ?>
                    <?php foreach ($videos as $v): ?>
                        <tr>
                            <td class="admin-td-id"><?= $v['id'] ?></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <?php if (!empty($v['thumbnail'])): ?>
                                        <img src="<?= htmlspecialchars($v['thumbnail']) ?>" alt="" class="admin-video-thumb">
                                    <?php else: ?>
                                        <div class="admin-video-thumb-placeholder">&#9654;</div>
                                    <?php endif; ?>
                                    <div class="product-cell">
                                        <strong><?= htmlspecialchars($v['title'] ?? '') ?></strong>
                                        <code class="admin-slug"><?= htmlspecialchars($v['slug'] ?? '') ?></code>
                                    </div>
                                </div>
                            </td>
                            <td><span class="admin-badge"><?= htmlspecialchars($categoryNames[$v['category_id'] ?? 0] ?? '-') ?></span></td>
                            <td><?= htmlspecialchars($categoryNames[$v['subcategory_id'] ?? 0] ?? '-') ?></td>
                            <td><?= htmlspecialchars($v['published_at'] ?? '-') ?></td>
                            <td>
                                <?php $isActive = !empty($v['is_active']); ?>
                                <span class="admin-status <?= $isActive ? 'admin-status-active' : 'admin-status-draft' ?>"><?= $isActive ? 'Activ' : 'Inactiv' ?></span>
                            </td>
                            <td class="admin-td-actions">
                                <?php if (!empty($v['tiktok_url'])): ?>
                                    <a href="<?= htmlspecialchars($v['tiktok_url']) ?>" class="btn btn-sm" target="_blank" title="TikTok">&#8599;</a>
                                <?php endif; ?>
                                <a href="/admin/videouri/editeaza/<?= $v['id'] ?>" class="btn btn-sm btn-outline" title="Editeaza">&#9998;</a>
                                <form method="post" action="/admin/videouri/sterge/<?= $v['id'] ?>" style="display:inline;" title="Sterge">
                                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sigur stergi videoul &quot;<?= htmlspecialchars($v['title'] ?? '') ?>&quot;?')">&#10005;</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<div class="admin-pagination">
    <?php
    $queryParams = $_GET;
    unset($queryParams['pagina']);
    $baseQuery = http_build_query($queryParams);
    $baseUrl = '/admin/videouri' . ($baseQuery ? '?' . $baseQuery . '&' : '?');
    ?>
    <?php if ($page > 1): ?>
        <a href="<?= $baseUrl ?>pagina=<?= $page - 1 ?>" class="btn btn-sm">&laquo; Inapoi</a>
    <?php endif; ?>
    <span class="admin-pagination-info">Pagina <?= $page ?> din <?= $totalPages ?></span>
    <?php if ($page < $totalPages): ?>
        <a href="<?= $baseUrl ?>pagina=<?= $page + 1 ?>" class="btn btn-sm">Inainte &raquo;</a>
    <?php endif; ?>
</div>
<?php endif; ?>
