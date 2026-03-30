<?php
/** @var array $articles */
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
        <span class="admin-toolbar-count"><?= $total ?> articole</span>
        <a href="/admin/blog/categorii" class="btn btn-sm btn-outline" style="margin-left: 0.5rem;">Categorii blog</a>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/blog/adauga" class="btn btn-primary">+ Adauga articol</a>
    </div>
</div>

<!-- Filters -->
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <div class="admin-card-body" style="padding: 1rem 1.25rem;">
        <form method="get" action="/admin/blog" class="admin-filters-row">
            <div class="admin-filter-group">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cauta articol..." class="admin-filter-input">
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
                    <option value="publicat" <?= $filterStatus === 'publicat' ? 'selected' : '' ?>>Publicat</option>
                    <option value="draft" <?= $filterStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="programat" <?= $filterStatus === 'programat' ? 'selected' : '' ?>>Programat</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-outline">Filtreaza</button>
            <?php if ($search || $filterCategory || $filterStatus): ?>
                <a href="/admin/blog" class="btn btn-sm" style="margin-left: 0.25rem;">Reseteaza</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Articles Table -->
<div class="admin-card">
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Articol</th>
                    <th>Categorie</th>
                    <th>Autor</th>
                    <th style="width: 110px;">Data</th>
                    <th style="width: 90px;">Status</th>
                    <th style="width: 140px;">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($articles)): ?>
                    <tr><td colspan="7" style="text-align: center; padding: 2rem;">Niciun articol gasit.</td></tr>
                <?php else: ?>
                    <?php foreach ($articles as $a): ?>
                        <tr>
                            <td class="admin-td-id"><?= $a['id'] ?></td>
                            <td>
                                <div class="product-cell">
                                    <strong><?= htmlspecialchars($a['title'] ?? '') ?></strong>
                                    <code class="admin-slug">/blog/<?= htmlspecialchars($a['slug'] ?? '') ?></code>
                                </div>
                            </td>
                            <td><span class="admin-badge"><?= htmlspecialchars($categoryNames[$a['category_id'] ?? 0] ?? '-') ?></span></td>
                            <td><?= htmlspecialchars($a['author'] ?? '-') ?></td>
                            <td>
                                <?= htmlspecialchars($a['date'] ?? '-') ?>
                                <?php if (($a['status'] ?? '') === 'programat' && strtotime($a['date'] ?? '') > time()): ?>
                                    <br><small style="color: var(--color-accent-blue);">programat</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $statusClass = match($a['status'] ?? 'draft') {
                                    'publicat' => 'admin-status-active',
                                    'programat' => 'admin-status-scheduled',
                                    default => 'admin-status-draft',
                                };
                                $statusLabel = match($a['status'] ?? 'draft') {
                                    'publicat' => 'Publicat',
                                    'programat' => 'Programat',
                                    default => 'Draft',
                                };
                                ?>
                                <span class="admin-status <?= $statusClass ?>"><?= $statusLabel ?></span>
                            </td>
                            <td class="admin-td-actions">
                                <a href="/blog/<?= htmlspecialchars($a['slug'] ?? '') ?>" class="btn btn-sm" target="_blank" title="Vezi pe site">&#8599;</a>
                                <a href="/admin/blog/editeaza/<?= $a['id'] ?>" class="btn btn-sm btn-outline" title="Editeaza">&#9998;</a>
                                <form method="post" action="/admin/blog/sterge/<?= $a['id'] ?>" style="display:inline;" title="Sterge">
                                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sigur stergi articolul &quot;<?= htmlspecialchars($a['title'] ?? '') ?>&quot;?')">&#10005;</button>
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
    $baseUrl = '/admin/blog' . ($baseQuery ? '?' . $baseQuery . '&' : '?');
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
