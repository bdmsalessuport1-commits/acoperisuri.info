<?php
/**
 * Breadcrumb dinamic
 * Variabile: $breadcrumbs = [['label' => 'Text', 'url' => '/path'], ...]
 */
$breadcrumbs = $breadcrumbs ?? [];
if (empty($breadcrumbs)) {
    return;
}
?>
<nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="container">
        <ol class="breadcrumb-list">
            <li class="breadcrumb-item">
                <a href="/">Acasa</a>
            </li>
            <?php foreach ($breadcrumbs as $i => $crumb): ?>
                <li class="breadcrumb-item">
                    <?php if (isset($crumb['url']) && $i < count($breadcrumbs) - 1): ?>
                        <a href="<?= htmlspecialchars($crumb['url']) ?>"><?= htmlspecialchars($crumb['label']) ?></a>
                    <?php else: ?>
                        <span><?= htmlspecialchars($crumb['label']) ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
