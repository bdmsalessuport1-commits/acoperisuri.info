<?php use App\Helpers\Auth; ?>

<div class="admin-toolbar">
    <div class="admin-toolbar-left">
        <span class="admin-toolbar-count"><?= count($subcategories) ?> subcategorii</span>
        <?php if (!empty($categories)): ?>
            <form method="GET" class="inline-form admin-filter-form">
                <select name="categorie" onchange="this.form.submit()">
                    <option value="">Toate categoriile</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ($filterCategory ?? 0) == $cat['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        <?php endif; ?>
    </div>
    <div class="admin-toolbar-right">
        <a href="/admin/subcategorii/adauga" class="btn btn-sm btn-primary">+ Adauga subcategorie</a>
    </div>
</div>

<?php if (!empty($flash)): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>

<div class="admin-table-wrap">
    <table class="admin-table" id="subcategories-table">
        <thead>
            <tr>
                <th class="th-drag"></th>
                <th class="th-order">#</th>
                <th>Subcategorie</th>
                <th>Categorie parinte</th>
                <th>Slug</th>
                <th class="th-count">Produse</th>
                <th class="th-status">Status</th>
                <th class="th-actions">Actiuni</th>
            </tr>
        </thead>
        <tbody id="sortable-subcategories">
            <?php foreach ($subcategories as $sub): ?>
                <tr data-id="<?= $sub['id'] ?>">
                    <td class="td-drag" title="Trage pentru reordonare">&#9776;</td>
                    <td class="td-order"><?= $sub['sort_order'] ?></td>
                    <td>
                        <div class="td-name">
                            <strong><?= htmlspecialchars($sub['name']) ?></strong>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-blue"><?= htmlspecialchars($categoryNames[$sub['category_id']] ?? '-') ?></span>
                    </td>
                    <td><code class="td-slug"><?= htmlspecialchars($sub['slug']) ?></code></td>
                    <td class="td-count"><?= $sub['count'] ?? 0 ?></td>
                    <td class="td-status">
                        <?php if ($sub['is_active']): ?>
                            <span class="badge badge-green">Activ</span>
                        <?php else: ?>
                            <span class="badge badge-red">Inactiv</span>
                        <?php endif; ?>
                    </td>
                    <td class="td-actions">
                        <a href="/admin/subcategorii/editeaza/<?= $sub['id'] ?>" class="btn-icon" title="Editeaza">&#9998;</a>
                        <?php if (($sub['count'] ?? 0) === 0): ?>
                            <form method="POST" action="/admin/subcategorii/sterge/<?= $sub['id'] ?>" class="inline-form" onsubmit="return confirm('Sigur doriti sa stergeti subcategoria \'<?= htmlspecialchars(addslashes($sub['name'])) ?>\'?')">
                                <?= Auth::csrfField() ?>
                                <button type="submit" class="btn-icon btn-icon-danger" title="Sterge">&#128465;</button>
                            </form>
                        <?php else: ?>
                            <span class="btn-icon btn-icon-disabled" title="Are produse asociate">&#128465;</span>
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
    const tbody = document.getElementById('sortable-subcategories');
    if (!tbody) return;
    let dragRow = null;

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

        fetch('/admin/subcategorii/reordoneaza', {
            method: 'POST',
            body: body
        });
    }
})();
</script>
