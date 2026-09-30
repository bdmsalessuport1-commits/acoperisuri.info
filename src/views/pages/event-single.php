<?php
/** @var array $event */
/** @var array $relatedEvents */
$months = [1=>'Ianuarie',2=>'Februarie',3=>'Martie',4=>'Aprilie',5=>'Mai',6=>'Iunie',
    7=>'Iulie',8=>'August',9=>'Septembrie',10=>'Octombrie',11=>'Noiembrie',12=>'Decembrie'];
$ts = strtotime($event['date'] ?? '');
$dateDisplay = $ts ? date('j', $ts) . ' ' . ($months[(int)date('n', $ts)] ?? '') . ' ' . date('Y', $ts) : '';
?>

<section class="section">
    <div class="container">
        <div class="blog-single-layout">
            <article class="blog-single-content">
                <header class="blog-single-header">
                    <div class="blog-card-date"><?= $dateDisplay ?><?php if (!empty($event['location'])): ?> &bull; <?= htmlspecialchars($event['location']) ?><?php endif; ?></div>
                    <h1><?= htmlspecialchars($event['title']) ?></h1>
                    <?php if (!empty($event['description'])): ?>
                        <p class="blog-single-excerpt"><?= htmlspecialchars($event['description']) ?></p>
                    <?php endif; ?>
                </header>

                <?php if (!empty($event['image_featured'])): ?>
                    <div class="blog-single-image">
                        <img src="<?= htmlspecialchars($event['image_featured']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" width="1200" height="630" loading="eager">
                    </div>
                <?php endif; ?>

                <div class="blog-single-body">
                    <?= $event['content'] ?? '' ?>
                </div>
            </article>

            <?php if (!empty($relatedEvents)): ?>
            <aside class="blog-sidebar">
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Alte evenimente</h3>
                    <?php foreach ($relatedEvents as $rel): ?>
                        <a href="/evenimente/<?= htmlspecialchars($rel['slug']) ?>" class="sidebar-popular-item">
                            <?= htmlspecialchars($rel['title']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </aside>
            <?php endif; ?>
        </div>
    </div>
</section>
