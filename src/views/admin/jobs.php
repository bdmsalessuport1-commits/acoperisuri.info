<?php
/** @var array $jobs */
/** @var string $filterStatus */
/** @var string $search */
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
        <span class="admin-toolbar-count"><?= $total ?> joburi</span>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/cariere/adauga" class="btn btn-primary">+ Adauga job</a>
    </div>
</div>

<!-- Filters -->
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <div class="admin-card-body" style="padding: 1rem 1.25rem;">
        <form method="get" action="/admin/cariere" class="admin-filters-row">
            <div class="admin-filter-group">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cauta job..." class="admin-filter-input">
            </div>
            <div class="admin-filter-group">
                <select name="status" class="admin-filter-select" onchange="this.form.submit()">
                    <option value="">Toate statusurile</option>
                    <option value="activ" <?= $filterStatus === 'activ' ? 'selected' : '' ?>>Activ</option>
                    <option value="inactiv" <?= $filterStatus === 'inactiv' ? 'selected' : '' ?>>Inactiv</option>
                </select>
            </div>
            <button type="submit" class="btn btn-sm btn-outline">Filtreaza</button>
            <?php if ($search || $filterStatus): ?>
                <a href="/admin/cariere" class="btn btn-sm" style="margin-left: 0.25rem;">Reseteaza</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Jobs Table -->
<div class="admin-card">
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Pozitie</th>
                    <th>Locatie</th>
                    <th style="width: 100px;">Tip</th>
                    <th style="width: 110px;">Data</th>
                    <th style="width: 90px;">Status</th>
                    <th style="width: 140px;">Actiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($jobs)): ?>
                    <tr><td colspan="7" style="text-align: center; padding: 2rem;">Niciun job gasit.</td></tr>
                <?php else: ?>
                    <?php foreach ($jobs as $j): ?>
                        <tr>
                            <td class="admin-td-id"><?= $j['id'] ?></td>
                            <td>
                                <div class="product-cell">
                                    <strong><?= htmlspecialchars($j['title'] ?? '') ?></strong>
                                    <code class="admin-slug">/cariere/<?= htmlspecialchars($j['slug'] ?? '') ?></code>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($j['location'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($j['type'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($j['date_posted'] ?? '-') ?></td>
                            <td>
                                <?php
                                $statusClass = ($j['status'] ?? 'activ') === 'activ' ? 'admin-status-active' : 'admin-status-draft';
                                $statusLabel = ($j['status'] ?? 'activ') === 'activ' ? 'Activ' : 'Inactiv';
                                ?>
                                <span class="admin-status <?= $statusClass ?>"><?= $statusLabel ?></span>
                            </td>
                            <td class="admin-td-actions">
                                <a href="/cariere/<?= htmlspecialchars($j['slug'] ?? '') ?>" class="btn btn-sm" target="_blank" title="Vezi pe site">&#8599;</a>
                                <a href="/admin/cariere/editeaza/<?= $j['id'] ?>" class="btn btn-sm btn-outline" title="Editeaza">&#9998;</a>
                                <form method="post" action="/admin/cariere/sterge/<?= $j['id'] ?>" style="display:inline;" title="Sterge">
                                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sigur stergi jobul &quot;<?= htmlspecialchars($j['title'] ?? '') ?>&quot;?')">&#10005;</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
