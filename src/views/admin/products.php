<?php
/** @var array $products */
/** @var array $categories */
/** @var array $subcategories */
/** @var array $categoryNames */
/** @var array $subcategoryNames */
/** @var array $manufacturers */
/** @var int $filterCategory */
/** @var int $filterSubcategory */
/** @var string $filterStatus */
/** @var string $filterManufacturer */
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
        <span class="admin-toolbar-count"><?= $total ?> produse</span>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/produse/adauga" class="btn btn-primary">+ Adauga produs</a>
    </div>
</div>

<!-- Filters -->
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <div class="admin-card-body" style="padding: 1rem 1.25rem;">
        <form method="get" action="/admin/produse" class="admin-filters-row">
            <div class="admin-filter-group">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cauta produs..." class="admin-filter-input">
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
                <select name="subcategorie" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="">Toate subcategoriile</option>
                    <?php foreach ($subcategories as $sub): ?>
                        <option value="<?= $sub['id'] ?>" <?= $filterSubcategory === $sub['id'] ? 'selected' : '' ?>
                            data-cat="<?= $sub['category_id'] ?>"><?= htmlspecialchars($sub['name']) ?> (<?= $categoryNames[$sub['category_id']] ?? '' ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="admin-filter-group">
                <select name="producator" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="">Toti producatorii</option>
                    <?php foreach ($manufacturers as $m): ?>
                        <option value="<?= htmlspecialchars($m) ?>" <?= $filterManufacturer === $m ? 'selected' : '' ?>><?= htmlspecialchars($m) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="admin-filter-group">
                <select name="status" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="">Toate statusurile</option>
                    <option value="activ" <?= $filterStatus === 'activ' ? 'selected' : '' ?>>Activ</option>
                    <option value="draft" <?= $filterStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="inactiv" <?= $filterStatus === 'inactiv' ? 'selected' : '' ?>>Inactiv</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-outline">Filtreaza</button>
            <?php if ($search || $filterCategory || $filterSubcategory || $filterStatus || $filterManufacturer): ?>
                <a href="/admin/produse" class="btn btn-sm" style="margin-left: 0.25rem;">Reseteaza</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Products Table -->
<div class="admin-card">
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Produs</th>
                    <th>Categorie</th>
                    <th>Producator</th>
                    <th style="width: 90px;">Status</th>
                    <th style="width: 180px;">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr><td colspan="6" style="text-align: center; padding: 2rem;">Niciun produs gasit.</td></tr>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td class="admin-td-id"><?= $p['id'] ?></td>
                            <td>
                                <div class="product-cell">
                                    <strong><?= htmlspecialchars($p['name'] ?? '') ?></strong>
                                    <code class="admin-slug">/produs/<?= htmlspecialchars($p['slug'] ?? '') ?></code>
                                </div>
                            </td>
                            <td>
                                <span class="admin-badge"><?= htmlspecialchars($categoryNames[$p['category_id'] ?? 0] ?? '-') ?></span>
                                <br><small style="color: var(--text-secondary);"><?= htmlspecialchars($subcategoryNames[$p['subcategory_id'] ?? 0] ?? '-') ?></small>
                            </td>
                            <td><?= htmlspecialchars($p['manufacturer'] ?? '-') ?></td>
                            <td>
                                <?php
                                $statusClass = match($p['status'] ?? 'draft') {
                                    'activ' => 'admin-status-active',
                                    'inactiv' => 'admin-status-inactive',
                                    default => 'admin-status-draft',
                                };
                                $statusLabel = match($p['status'] ?? 'draft') {
                                    'activ' => 'Activ',
                                    'inactiv' => 'Inactiv',
                                    default => 'Draft',
                                };
                                ?>
                                <span class="admin-status <?= $statusClass ?>"><?= $statusLabel ?></span>
                            </td>
                            <td class="admin-td-actions">
                                <a href="/produs/<?= htmlspecialchars($p['slug'] ?? '') ?>" class="btn btn-sm" target="_blank" title="Vezi pe site">&#8599;</a>
                                <a href="/admin/produse/editeaza/<?= $p['id'] ?>" class="btn btn-sm btn-outline" title="Editeaza">&#9998;</a>
                                <form method="post" action="/admin/produse/duplica/<?= $p['id'] ?>" style="display:inline;" title="Duplica">
                                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                                    <button type="submit" class="btn btn-sm" onclick="return confirm('Duplica acest produs?')">&#9851;</button>
                                </form>
                                <form method="post" action="/admin/produse/sterge/<?= $p['id'] ?>" style="display:inline;" title="Sterge">
                                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sigur stergi produsul &quot;<?= htmlspecialchars($p['name'] ?? '') ?>&quot;?')">&#10005;</button>
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
    $baseUrl = '/admin/produse' . ($baseQuery ? '?' . $baseQuery . '&' : '?');
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
