<?php
/**
 * SERP Preview + SEO Score partial
 * Include in any admin form that has seo_title, seo_description, slug fields
 *
 * Variables: $formData (with seo_title, seo_description, slug), $slugPrefix (e.g. '/produs/')
 */
$slugPrefix = $slugPrefix ?? '/';
$seoTitle = $formData['seo_title'] ?? $formData['name'] ?? '';
$seoDesc = $formData['seo_description'] ?? $formData['description'] ?? '';
$seoSlug = $formData['slug'] ?? '';
$seoScore = \App\Helpers\SeoHelper::score($seoTitle, $seoDesc, $seoSlug);
?>
<div class="admin-card">
    <div class="admin-card-header">SEO Preview</div>
    <div class="admin-card-body">
        <!-- SERP Preview -->
        <div class="serp-preview" id="serpPreview">
            <div class="serp-title" id="serpTitle"><?= htmlspecialchars($seoTitle ?: 'Titlu pagina') ?></div>
            <div class="serp-url" id="serpUrl">acoperisuri.info<?= htmlspecialchars($slugPrefix . $seoSlug) ?></div>
            <div class="serp-desc" id="serpDesc"><?= htmlspecialchars($seoDesc ?: 'Meta description va aparea aici...') ?></div>
        </div>

        <!-- SEO Score -->
        <div class="seo-score-block">
            <div class="seo-score-circle seo-score-<?= $seoScore['color'] ?>">
                <span><?= $seoScore['score'] ?></span>
            </div>
            <div class="seo-score-details">
                <strong>Scor SEO: <?= $seoScore['score'] ?>/100</strong>
                <?php if (!empty($seoScore['issues'])): ?>
                    <ul class="seo-score-issues">
                        <?php foreach ($seoScore['issues'] as $issue): ?>
                            <li><?= htmlspecialchars($issue) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p style="color: #065f46; font-size: var(--text-xs); margin: 0.25rem 0 0;">Toate criteriile SEO sunt indeplinite.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const titleInput = document.querySelector('input[name="seo_title"], input[name="name"]');
    const descInput = document.querySelector('textarea[name="seo_description"], textarea[name="description"]');
    const slugInput = document.querySelector('input[name="slug"]');

    function updateSerp() {
        const seoTitleEl = document.querySelector('input[name="seo_title"]');
        const nameEl = document.querySelector('input[name="name"]');
        const title = (seoTitleEl && seoTitleEl.value) || (nameEl && nameEl.value) || 'Titlu pagina';

        const seoDescEl = document.querySelector('textarea[name="seo_description"]');
        const descEl = document.querySelector('textarea[name="description"]');
        const desc = (seoDescEl && seoDescEl.value) || (descEl && descEl.value) || 'Meta description va aparea aici...';

        const slug = slugInput ? slugInput.value : '';

        document.getElementById('serpTitle').textContent = title;
        document.getElementById('serpUrl').textContent = 'acoperisuri.info<?= $slugPrefix ?>' + slug;
        document.getElementById('serpDesc').textContent = desc.substring(0, 160);
    }

    if (titleInput) titleInput.addEventListener('input', updateSerp);
    if (descInput) descInput.addEventListener('input', updateSerp);
    if (slugInput) slugInput.addEventListener('input', updateSerp);

    // Also listen on seo-specific fields
    const seoTitle = document.querySelector('input[name="seo_title"]');
    const seoDesc = document.querySelector('textarea[name="seo_description"]');
    if (seoTitle && seoTitle !== titleInput) seoTitle.addEventListener('input', updateSerp);
    if (seoDesc && seoDesc !== descInput) seoDesc.addEventListener('input', updateSerp);
})();
</script>
