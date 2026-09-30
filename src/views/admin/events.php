<?php
/** @var array $events */
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
        <span class="admin-toolbar-count"><?= $total ?> evenimente</span>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/evenimente/adauga" class="btn btn-primary">+ Adauga eveniment</a>
    </div>
</div>

<!-- Filters -->
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <div class="admin-card-body" style="padding: 1rem 1.25rem;">
        <form method="get" action="/admin/evenimente" class="admin-filters-row">
            <div class="admin-filter-group">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cauta eveniment..." class="admin-filter-input">
            </div>
            <div class="admin-filter-group">
                <select name="status" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="">Toate statusurile</option>
                    <option value="publicat" <?= $filterStatus === 'publicat' ? 'selected' : '' ?>>Publicat</option>
                    <option value="draft" <?= $filterStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-outline">Filtreaza</button>
            <?php if ($search || $filterStatus): ?>
                <a href="/admin/evenimente" class="btn btn-sm" style="margin-left: 0.25rem;">Reseteaza</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Events Table -->
<div class="admin-card">
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Eveniment</th>
                    <th>Locatie</th>
                    <th style="width: 110px;">Data</th>
                    <th style="width: 90px;">Status</th>
                    <th style="width: 140px;">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($events)): ?>
                    <tr><td colspan="6" style="text-align: center; padding: 2rem;">Niciun eveniment gasit.</td></tr>
                <?php else: ?>
                    <?php foreach ($events as $e): ?>
                        <tr>
                            <td class="admin-td-id"><?= $e['id'] ?></td>
                            <td>
                                <div class="product-cell">
                                    <strong><?= htmlspecialchars($e['title'] ?? '') ?></strong>
                                    <code class="admin-slug">/evenimente/<?= htmlspecialchars($e['slug'] ?? '') ?></code>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($e['location'] ?? '-') ?></td>
                            <td>
                                <?= htmlspecialchars($e['event_date'] ?? '-') ?>
                                <?php if (!empty($e['event_time'])): ?>
                                    <br><small><?= htmlspecialchars($e['event_time']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $statusClass = ($e['status'] ?? 'draft') === 'publicat' ? 'admin-status-active' : 'admin-status-draft';
                                $statusLabel = ($e['status'] ?? 'draft') === 'publicat' ? 'Publicat' : 'Draft';
                                ?>
                                <span class="admin-status <?= $statusClass ?>"><?= $statusLabel ?></span>
                            </td>
                            <td class="admin-td-actions">
                                <a href="/evenimente/<?= htmlspecialchars($e['slug'] ?? '') ?>" class="btn btn-sm" target="_blank" title="Vezi pe site">&#8599;</a>
                                <a href="/admin/evenimente/editeaza/<?= $e['id'] ?>" class="btn btn-sm btn-outline" title="Editeaza">&#9998;</a>
                                <form method="post" action="/admin/evenimente/sterge/<?= $e['id'] ?>" style="display:inline;" title="Sterge">
                                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sigur stergi evenimentul &quot;<?= htmlspecialchars($e['title'] ?? '') ?>&quot;?')">&#10005;</button>
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
    $baseUrl = '/admin/evenimente' . ($baseQuery ? '?' . $baseQuery . '&' : '?');
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
