<?php
/** @var array $media */
/** @var int $total */
/** @var array $zones */
/** @var string $filterZone */
/** @var string $filterType */
/** @var string $search */
/** @var array|null $flash */
$csrfToken = \App\Helpers\Auth::csrfToken();

if (!function_exists('formatSize')) {
    function formatSize(int $bytes): string {
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 1) . ' MB';
    }
}
?>

<?php if ($flash): ?>
    <div class="admin-flash admin-flash-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['message']) ?></div>
<?php endif; ?>

<!-- Upload Area -->
<div class="admin-card media-upload-card">
    <div class="admin-card-header">
        Upload imagini
        <div style="margin-left: auto; display: flex; gap: 0.5rem; align-items: center;">
            <select id="uploadZone" class="admin-filter-select" style="min-width: 170px;">
                <?php foreach ($zones as $key => $z): ?>
                    <option value="<?= $key ?>"><?= htmlspecialchars($z['label']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="admin-card-body">
        <div class="media-dropzone" id="dropzone">
            <div class="media-dropzone-inner">
                <div class="media-dropzone-icon">&#128247;</div>
                <p class="media-dropzone-text">Trage fisierele aici sau <label for="fileInput" class="media-dropzone-link">alege de pe calculator</label></p>
                <p class="media-dropzone-hint" id="zoneHint">Max 1200x1200px, orice format</p>
                <input type="file" id="fileInput" multiple accept="image/jpeg,image/png,image/webp,image/gif" style="display:none;">
            </div>
            <div class="media-dropzone-progress" id="uploadProgress" style="display:none;">
                <div class="media-progress-bar"><div class="media-progress-fill" id="progressFill"></div></div>
                <span class="media-progress-text" id="progressText">Se uploadeaza...</span>
            </div>
        </div>

        <!-- Zone dimension hints -->
        <div class="media-zone-hints">
            <strong>Dimensiuni recomandate per zona:</strong>
            <div class="media-hints-grid">
                <?php foreach ($zones as $key => $z): ?>
                    <?php if ($key === 'thumbnail') continue; ?>
                    <div class="media-hint-item" data-zone="<?= $key ?>">
                        <span class="media-hint-label"><?= htmlspecialchars($z['label']) ?></span>
                        <span class="media-hint-value"><?= htmlspecialchars($z['hint']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Toolbar + Filters -->
<div class="admin-toolbar">
    <div class="admin-toolbar-left">
        <span class="admin-toolbar-count"><?= $total ?> fisiere</span>
    </div>
    <div class="admin-toolbar-right">
        <form method="get" action="/admin/media" class="admin-filters-row">
            <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cauta..." class="admin-filter-input" style="min-width: 130px;">
            <select name="zona" class="admin-filter-select" onchange="this.form.submit()">
                <option value="">Toate zonele</option>
                <?php foreach ($zones as $key => $z): ?>
                    <option value="<?= $key ?>" <?= $filterZone === $key ? 'selected' : '' ?>><?= htmlspecialchars($z['label']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="tip" class="admin-filter-select" onchange="this.form.submit()">
                <option value="">Toate tipurile</option>
                <option value="imagine" <?= $filterType === 'imagine' ? 'selected' : '' ?>>Imagini</option>
            </select>
            <button type="submit" class="btn btn-sm btn-outline">Filtreaza</button>
            <?php if ($search || $filterZone || $filterType): ?>
                <a href="/admin/media" class="btn btn-sm">Reseteaza</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- Media Gallery Grid -->
<?php if (empty($media)): ?>
    <div class="admin-card">
        <div class="admin-card-body" style="text-align: center; padding: 3rem;">
            <p style="color: var(--text-secondary); margin: 0;">Nicio imagine uploadata<?= ($filterZone || $filterType || $search) ? ' pentru filtrele selectate' : '' ?>.</p>
        </div>
    </div>
<?php else: ?>
    <div class="media-gallery" id="mediaGallery">
        <?php foreach ($media as $m): ?>
            <div class="media-item" data-id="<?= $m['id'] ?>">
                <div class="media-thumb">
                    <img src="<?= htmlspecialchars($m['thumb_url'] ?? $m['url'] ?? '') ?>" alt="<?= htmlspecialchars($m['alt'] ?? $m['original_name'] ?? '') ?>" loading="lazy">
                </div>
                <div class="media-info">
                    <span class="media-filename" title="<?= htmlspecialchars($m['original_name'] ?? '') ?>"><?= htmlspecialchars(mb_substr($m['original_name'] ?? $m['filename'] ?? '', 0, 25)) ?></span>
                    <span class="media-meta">
                        <?= ($m['width'] ?? 0) ?>x<?= ($m['height'] ?? 0) ?>
                        &middot; <?= formatSize($m['size'] ?? 0) ?>
                        <?php if (!empty($m['zone']) && $m['zone'] !== 'general'): ?>
                            &middot; <span class="media-zone-badge"><?= htmlspecialchars($zones[$m['zone']]['label'] ?? $m['zone']) ?></span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="media-actions">
                    <button type="button" class="btn btn-sm btn-outline" onclick="copyUrl('<?= htmlspecialchars($m['url'] ?? '') ?>')" title="Copiaza URL">&#128203;</button>
                    <form method="post" action="/admin/media/sterge/<?= $m['id'] ?>" style="display:inline;">
                        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Stergi aceasta imagine?')" title="Sterge">&times;</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<script>
const csrfToken = '<?= $csrfToken ?>';
const zoneHints = <?= json_encode(array_map(fn($z) => $z['hint'], $zones)) ?>;

// Zone selector changes hint
document.getElementById('uploadZone').addEventListener('change', function() {
    document.getElementById('zoneHint').textContent = zoneHints[this.value] || '';
});

// Drag & Drop
const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('fileInput');

['dragenter', 'dragover'].forEach(evt => {
    dropzone.addEventListener(evt, e => {
        e.preventDefault();
        dropzone.classList.add('media-dropzone-active');
    });
});

['dragleave', 'drop'].forEach(evt => {
    dropzone.addEventListener(evt, e => {
        e.preventDefault();
        dropzone.classList.remove('media-dropzone-active');
    });
});

dropzone.addEventListener('drop', e => {
    const files = e.dataTransfer.files;
    if (files.length) uploadFiles(files);
});

fileInput.addEventListener('change', () => {
    if (fileInput.files.length) uploadFiles(fileInput.files);
});

function uploadFiles(files) {
    const zone = document.getElementById('uploadZone').value;
    const formData = new FormData();
    formData.append('_csrf_token', csrfToken);
    formData.append('zone', zone);

    for (let i = 0; i < files.length; i++) {
        formData.append('media_files[]', files[i]);
    }

    const progress = document.getElementById('uploadProgress');
    const fill = document.getElementById('progressFill');
    const text = document.getElementById('progressText');
    progress.style.display = '';
    fill.style.width = '0%';
    text.textContent = 'Se uploadeaza ' + files.length + ' fisier(e)...';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/admin/media/upload');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.upload.addEventListener('progress', e => {
        if (e.lengthComputable) {
            const pct = Math.round((e.loaded / e.total) * 100);
            fill.style.width = pct + '%';
            text.textContent = pct + '% uploadat...';
        }
    });

    xhr.addEventListener('load', () => {
        if (xhr.status === 200) {
            try {
                const resp = JSON.parse(xhr.responseText);
                if (resp.success) {
                    text.textContent = 'Upload complet! Se reincarca...';
                    fill.style.width = '100%';
                    setTimeout(() => location.reload(), 500);
                } else {
                    text.textContent = 'Eroare: ' + (resp.error || 'Upload esuat');
                    fill.style.background = '#f87171';
                }
            } catch(e) {
                text.textContent = 'Eroare la procesare raspuns';
            }
        } else {
            text.textContent = 'Eroare server: ' + xhr.status;
        }
    });

    xhr.addEventListener('error', () => {
        text.textContent = 'Eroare de retea';
    });

    xhr.send(formData);
    fileInput.value = '';
}

function copyUrl(url) {
    const full = window.location.origin + url;
    navigator.clipboard.writeText(full).then(() => {
        const btn = event.target;
        const orig = btn.innerHTML;
        btn.innerHTML = '&#10003;';
        setTimeout(() => btn.innerHTML = orig, 1500);
    });
}
</script>
