<?php use App\Helpers\Auth; ?>

<div class="admin-toolbar">
    <div class="admin-toolbar-left">
        <span class="admin-toolbar-count"><?= count($categories) ?> categorii</span>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/categorii/adauga" class="btn btn-sm btn-primary">+ Adauga categorie</a>
    </div>
</div>

<?php if (!empty($flash)): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<div class="admin-table-wrap">
    <table class="admin-table" id="categories-table">
        <thead>
            <tr>
                <th class="th-drag"></th>
                <th class="th-order">#</th>
                <th>Categorie</th>
                <th>Slug</th>
                <th class="th-count">Subcategorii</th>
                <th class="th-status">Status</th>
                <th class="th-actions">Actiuni</th>
            </tr>
        </thead>
        <tbody id="sortable-categories">
            <?php foreach ($categories as $cat): ?>
                <tr data-id="<?= $cat['id'] ?>">
                    <td class="td-drag" title="Trage pentru reordonare">&#9776;</td>
                    <td class="td-order"><?= $cat['sort_order'] ?></td>
                    <td>
                        <div class="td-name">
                            <span class="td-icon"><?= $cat['icon'] ?></span>
                            <div>
                                <strong><?= htmlspecialchars($cat['name']) ?></strong>
                                <small class="td-desc"><?= htmlspecialchars(mb_strimwidth($cat['description'], 0, 60, '...')) ?></small>
                            </div>
                        </div>
                    </td>
                    <td><code class="td-slug">/<?= htmlspecialchars($cat['slug']) ?></code></td>
                    <td class="td-count"><?= $subcategoryCounts[$cat['id']] ?? 0 ?></td>
                    <td class="td-status">
                        <?php if ($cat['is_active']): ?>
                            <span class="badge badge-green">Activ</span>
                        <?php else: ?>
                            <span class="badge badge-red">Inactiv</span>
                        <?php endif; ?>
                    </td>
                    <td class="td-actions">
                        <a href="/<?= $cat['slug'] ?>" class="btn-icon" title="Vezi pe site" target="_blank">&#8599;</a>
                        <a href="/admin/categorii/editeaza/<?= $cat['id'] ?>" class="btn-icon" title="Editeaza">&#9998;</a>
                        <?php if (($subcategoryCounts[$cat['id']] ?? 0) === 0): ?>
                            <form method="POST" action="/admin/categorii/sterge/<?= $cat['id'] ?>" class="inline-form" onsubmit="return confirm('Sigur doriti sa stergeti categoria \'<?= htmlspecialchars(addslashes($cat['name'])) ?>\'?')">
                                <?= Auth::csrfField() ?>
                                <button type="submit" class="btn-icon btn-icon-danger" title="Sterge">&#128465;</button>
                            </form>
                        <?php else: ?>
                            <span class="btn-icon btn-icon-disabled" title="Are subcategorii asociate">&#128465;</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
// Drag & drop reordonare
(function() {
    const tbody = document.getElementById('sortable-categories');
    if (!tbody) return;
    let dragRow = null;

    tbody.querySelectorAll('tr').forEach(row => {
        const handle = row.querySelector('.td-drag');
        if (!handle) return;

        handle.style.cursor = 'grab';

        handle.addEventListener('mousedown', () => {
            dragRow = row;
            row.classList.add('dragging');
        });
    });

    tbody.addEventListener('dragover', e => e.preventDefault());

    document.addEventListener('mouseup', () => {
        if (dragRow) {
            dragRow.classList.remove('dragging');
            dragRow = null;
        }
    });

    // Simplified: use drag events on rows
    tbody.querySelectorAll('tr').forEach(row => {
        row.draggable = true;

        row.addEventListener('dragstart', e => {
            dragRow = row;
            row.classList.add('dragging');
            e.dataTransfer.effectAllowed = 'move';
        });

        row.addEventListener('dragend', () => {
            row.classList.remove('dragging');
            saveOrder();
        });

        row.addEventListener('dragover', e => {
            e.preventDefault();
            if (!dragRow || dragRow === row) return;
            const rect = row.getBoundingClientRect();
            const mid = rect.top + rect.height / 2;
            if (e.clientY < mid) {
                tbody.insertBefore(dragRow, row);
            } else {
                tbody.insertBefore(dragRow, row.nextSibling);
            }
        });
    });

    function saveOrder() {
        const rows = tbody.querySelectorAll('tr');
        const order = {};
        rows.forEach((r, i) => {
            order[r.dataset.id] = i + 1;
            r.querySelector('.td-order').textContent = i + 1;
        });

        const csrf = document.querySelector('input[name="_csrf_token"]')?.value || '';
        const body = new URLSearchParams();
        body.append('_csrf_token', csrf);
        body.append('order', JSON.stringify(order));

        fetch('/admin/categorii/reordoneaza', {
            method: 'POST',
            body: body
        });
    }
})();
</script>
