<?php
/** @var array $formData */
/** @var array $errors */
/** @var array $categories */
/** @var bool $isEdit */
$csrfToken = \App\Helpers\Auth::csrfToken();
$action = $isEdit ? '/admin/blog/editeaza/' . ($formData['id'] ?? 0) : '/admin/blog/adauga';
?>

<?php if (!empty($errors)): ?>
    <div class="admin-flash admin-flash-error">
        <ul style="margin: 0; padding-left: 1.25rem;">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= $action ?>" id="blogForm">
    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

    <div class="admin-form-grid">
        <!-- MAIN COLUMN -->
        <div class="admin-form-main">

            <!-- Basic Info -->
            <div class="admin-card">
                <div class="admin-card-header">Informatii articol</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>Titlu *</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($formData['title'] ?? '') ?>" required id="titleInput">
                    </div>
                    <div class="admin-field">
                        <label>Slug *</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="text" name="slug" value="<?= htmlspecialchars($formData['slug'] ?? '') ?>" required id="slugInput" style="flex: 1;">
                            <button type="button" class="btn btn-sm btn-outline" onclick="generateSlug()">Auto</button>
                        </div>
                        <small class="admin-field-hint">URL: /blog/<span id="slugPreview"><?= htmlspecialchars($formData['slug'] ?? '') ?></span></small>
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field">
                            <label>Categorie *</label>
                            <select name="category_id" required>
                                <option value="">— Selecteaza —</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($formData['category_id'] ?? 0) == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="admin-field">
                            <label>Autor</label>
                            <input type="text" name="author" value="<?= htmlspecialchars($formData['author'] ?? 'Echipa BDM Systems') ?>">
                        </div>
                    </div>
                    <div class="admin-field">
                        <label>Excerpt (rezumat scurt)</label>
                        <textarea name="excerpt" rows="3" maxlength="300"><?= htmlspecialchars($formData['excerpt'] ?? '') ?></textarea>
                        <small class="admin-field-hint">Apare in lista de articole si in meta description daca SEO description este gol. Max 300 caractere.</small>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="admin-card">
                <div class="admin-card-header">Imagine featured</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>URL imagine featured</label>
                        <input type="text" name="image_featured" value="<?= htmlspecialchars($formData['image_featured'] ?? '') ?>" placeholder="/uploads/blog-articol.webp">
                        <small class="admin-field-hint">Dimensiune recomandata: 1200x630px. Uploadati prin Media Manager.</small>
                    </div>
                    <div class="admin-field-row">
                        <div class="admin-field">
                            <label>Icon (HTML entity)</label>
                            <input type="text" name="image_icon" value="<?= htmlspecialchars($formData['image_icon'] ?? '') ?>" placeholder="&#127968;">
                            <small class="admin-field-hint">Folosit ca fallback daca nu exista imagine.</small>
                        </div>
                        <div class="admin-field">
                            <label>Culoare fundal icon</label>
                            <input type="color" name="image_color" value="<?= htmlspecialchars($formData['image_color'] ?? '#1a4a7a') ?>" style="width: 60px; height: 38px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Editor -->
            <div class="admin-card">
                <div class="admin-card-header">
                    Continut articol *
                </div>
                <div class="admin-card-body" style="padding: 0;">
                    <!-- Editor Toolbar -->
                    <div class="editor-toolbar" id="editorToolbar">
                        <select onchange="execFormat(this.value); this.selectedIndex=0;" title="Heading">
                            <option value="">Heading</option>
                            <option value="h2">H2</option>
                            <option value="h3">H3</option>
                            <option value="h4">H4</option>
                            <option value="p">Paragraf</option>
                        </select>
                        <button type="button" onclick="execCmd('bold')" title="Bold"><strong>B</strong></button>
                        <button type="button" onclick="execCmd('italic')" title="Italic"><em>I</em></button>
                        <button type="button" onclick="execCmd('underline')" title="Underline"><u>U</u></button>
                        <span class="editor-sep"></span>
                        <button type="button" onclick="execCmd('insertUnorderedList')" title="Lista">&#8226; Lista</button>
                        <button type="button" onclick="execCmd('insertOrderedList')" title="Lista numerotata">1. Lista</button>
                        <button type="button" onclick="insertBlockquote()" title="Citat">&#10077; Citat</button>
                        <span class="editor-sep"></span>
                        <button type="button" onclick="insertLink()" title="Link">&#128279; Link</button>
                        <button type="button" onclick="insertImage()" title="Imagine">&#128247; Imagine</button>
                        <button type="button" onclick="insertTable()" title="Tabel">&#9638; Tabel</button>
                        <button type="button" onclick="insertVideo()" title="Video embed">&#9654; Video</button>
                        <span class="editor-sep"></span>
                        <button type="button" onclick="toggleSource()" title="Cod sursa" id="btnSource">&#60;/&#62; HTML</button>
                    </div>
                    <!-- Visual Editor -->
                    <div class="editor-content" contenteditable="true" id="visualEditor"><?= $formData['content'] ?? '' ?></div>
                    <!-- Source Editor (hidden by default) -->
                    <textarea name="content" id="sourceEditor" class="editor-source" style="display:none;"><?= htmlspecialchars($formData['content'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- SEO -->
            <div class="admin-card">
                <div class="admin-card-header">SEO</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>SEO Title</label>
                        <input type="text" name="seo_title" value="<?= htmlspecialchars($formData['seo_title'] ?? '') ?>" maxlength="70">
                        <small class="admin-field-hint">Max 70 caractere. Daca e gol, se foloseste titlul articolului.</small>
                    </div>
                    <div class="admin-field">
                        <label>SEO Description</label>
                        <textarea name="seo_description" rows="2" maxlength="160"><?= htmlspecialchars($formData['seo_description'] ?? '') ?></textarea>
                        <small class="admin-field-hint">Max 160 caractere. Daca e gol, se foloseste excerpt-ul.</small>
                    </div>
                </div>
            </div>

            <!-- Tags & Related Products -->
            <div class="admin-card">
                <div class="admin-card-header">Tags si produse asociate</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>Tags (separate prin virgula)</label>
                        <input type="text" name="tags" value="<?= htmlspecialchars(implode(', ', $formData['tags'] ?? [])) ?>" placeholder="tigla metalica, ghid, 2025">
                    </div>
                    <div class="admin-field">
                        <label>Produse asociate</label>
                        <div id="relatedProducts">
                            <?php foreach (($formData['related_products'] ?? []) as $i => $rp): ?>
                                <div class="admin-dynamic-row">
                                    <input type="text" name="rp_slug[]" value="<?= htmlspecialchars($rp['slug'] ?? '') ?>" placeholder="slug-produs" style="flex: 1;">
                                    <input type="text" name="rp_name[]" value="<?= htmlspecialchars($rp['name'] ?? '') ?>" placeholder="Nume produs" style="flex: 1;">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">&#10005;</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline" onclick="addRelatedProduct()" style="margin-top: 0.5rem;">+ Adauga produs</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="admin-form-side">

            <!-- Publish -->
            <div class="admin-card">
                <div class="admin-card-header">Publicare</div>
                <div class="admin-card-body">
                    <div class="admin-field">
                        <label>Status</label>
                        <select name="status">
                            <option value="draft" <?= ($formData['status'] ?? 'draft') === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="publicat" <?= ($formData['status'] ?? '') === 'publicat' ? 'selected' : '' ?>>Publicat</option>
                            <option value="programat" <?= ($formData['status'] ?? '') === 'programat' ? 'selected' : '' ?>>Programat</option>
                        </select>
                    </div>
                    <div class="admin-field">
                        <label>Data publicare</label>
                        <input type="date" name="date" value="<?= htmlspecialchars($formData['date'] ?? date('Y-m-d')) ?>">
                        <small class="admin-field-hint">Pentru "Programat", setati o data viitoare.</small>
                    </div>
                    <div class="admin-field">
                        <label>Timp lectura (minute)</label>
                        <input type="number" name="read_time" value="<?= (int)($formData['read_time'] ?? 0) ?>" min="0" max="60">
                    </div>
                    <div class="admin-field">
                        <label>Ordine sortare</label>
                        <input type="number" name="sort_order" value="<?= (int)($formData['sort_order'] ?? 0) ?>" min="0">
                    </div>
                    <?php if ($isEdit && !empty($formData['created_at'])): ?>
                        <div style="font-size: var(--text-xs); color: var(--color-text-light); margin-top: 0.5rem;">
                            Creat: <?= htmlspecialchars($formData['created_at'] ?? '') ?><br>
                            Modificat: <?= htmlspecialchars($formData['updated_at'] ?? '') ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;"><?= $isEdit ? 'Actualizeaza articolul' : 'Salveaza articolul' ?></button>
                </div>
            </div>

            <!-- SEO Preview -->
            <?php
            $slugPrefix = '/blog/';
            \App\Helpers\View::partial('admin-seo-preview', [
                'formData' => [
                    'seo_title' => $formData['seo_title'] ?? $formData['title'] ?? '',
                    'seo_description' => $formData['seo_description'] ?? $formData['excerpt'] ?? '',
                    'slug' => $formData['slug'] ?? '',
                    'name' => $formData['title'] ?? '',
                    'description' => $formData['excerpt'] ?? '',
                ],
                'slugPrefix' => $slugPrefix,
            ]);
            ?>

            <!-- Quick Actions -->
            <?php if ($isEdit): ?>
            <div class="admin-card">
                <div class="admin-card-header">Actiuni</div>
                <div class="admin-card-body">
                    <a href="/blog/<?= htmlspecialchars($formData['slug'] ?? '') ?>" class="btn btn-sm btn-outline btn-block" target="_blank">&#8599; Vezi pe site</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</form>

<script>
// Slug auto-generation
function generateSlug() {
    const title = document.getElementById('titleInput').value;
    const slug = title.toLowerCase()
        .replace(/[ăâ]/g, 'a').replace(/[îi]/g, 'i').replace(/[ș]/g, 's').replace(/[ț]/g, 't')
        .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
    document.getElementById('slugInput').value = slug;
    document.getElementById('slugPreview').textContent = slug;
}
document.getElementById('slugInput').addEventListener('input', function() {
    document.getElementById('slugPreview').textContent = this.value;
});

// Related products
function addRelatedProduct() {
    const container = document.getElementById('relatedProducts');
    const row = document.createElement('div');
    row.className = 'admin-dynamic-row';
    row.innerHTML = `
        <input type="text" name="rp_slug[]" placeholder="slug-produs" style="flex: 1;">
        <input type="text" name="rp_name[]" placeholder="Nume produs" style="flex: 1;">
        <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">&#10005;</button>
    `;
    container.appendChild(row);
}

// ─── WYSIWYG Editor ──────────────────────────────────────
const visualEditor = document.getElementById('visualEditor');
const sourceEditor = document.getElementById('sourceEditor');
let isSourceMode = false;

function execCmd(cmd) {
    document.execCommand(cmd, false, null);
    visualEditor.focus();
}

function execFormat(tag) {
    if (!tag) return;
    document.execCommand('formatBlock', false, '<' + tag + '>');
    visualEditor.focus();
}

function insertLink() {
    const url = prompt('URL link:', 'https://');
    if (url) document.execCommand('createLink', false, url);
    visualEditor.focus();
}

function insertImage() {
    const url = prompt('URL imagine:', '/uploads/');
    if (url) document.execCommand('insertImage', false, url);
    visualEditor.focus();
}

function insertBlockquote() {
    document.execCommand('formatBlock', false, '<blockquote>');
    visualEditor.focus();
}

function insertTable() {
    const rows = prompt('Numar randuri (inclusiv header):', '3');
    const cols = prompt('Numar coloane:', '3');
    if (!rows || !cols) return;
    let html = '<table><thead><tr>';
    for (let c = 0; c < cols; c++) html += '<th>Header ' + (c+1) + '</th>';
    html += '</tr></thead><tbody>';
    for (let r = 1; r < rows; r++) {
        html += '<tr>';
        for (let c = 0; c < cols; c++) html += '<td>...</td>';
        html += '</tr>';
    }
    html += '</tbody></table>';
    document.execCommand('insertHTML', false, html);
    visualEditor.focus();
}

function insertVideo() {
    const url = prompt('URL video (YouTube/TikTok embed):', '');
    if (!url) return;
    const html = '<div class="video-embed"><iframe src="' + url + '" frameborder="0" allowfullscreen style="width:100%;height:400px;"></iframe></div>';
    document.execCommand('insertHTML', false, html);
    visualEditor.focus();
}

function toggleSource() {
    isSourceMode = !isSourceMode;
    const btn = document.getElementById('btnSource');
    if (isSourceMode) {
        sourceEditor.value = visualEditor.innerHTML;
        visualEditor.style.display = 'none';
        sourceEditor.style.display = 'block';
        btn.classList.add('active');
    } else {
        visualEditor.innerHTML = sourceEditor.value;
        sourceEditor.style.display = 'none';
        visualEditor.style.display = 'block';
        btn.classList.remove('active');
    }
}

// Sync content before submit
document.getElementById('blogForm').addEventListener('submit', function() {
    if (!isSourceMode) {
        sourceEditor.value = visualEditor.innerHTML;
    }
});
</script>
