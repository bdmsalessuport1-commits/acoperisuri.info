<?php
/** @var array $events */
$months = [1=>'Ianuarie',2=>'Februarie',3=>'Martie',4=>'Aprilie',5=>'Mai',6=>'Iunie',
    7=>'Iulie',8=>'August',9=>'Septembrie',10=>'Octombrie',11=>'Noiembrie',12=>'Decembrie'];
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Evenimente</h1>
            <p>Evenimentele la care participam si pe care le organizam.</p>
        </div>

        <?php if (empty($events)): ?>
            <div class="page-placeholder">
                <div class="placeholder-icon">&#128197;</div>
                <h2>Niciun eveniment momentan</h2>
                <p>Reveniti curand pentru a vedea evenimentele viitoare.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-3">
                <?php foreach ($events as $event):
                    $ts = strtotime($event['date'] ?? '');
                    $dateDisplay = $ts ? date('j', $ts) . ' ' . ($months[(int)date('n', $ts)] ?? '') . ' ' . date('Y', $ts) : '';
                ?>
                <div class="blog-card">
                    <div class="blog-card-image">
                        <?php if (!empty($event['image_featured'])): ?>
                            <img src="<?= htmlspecialchars($event['image_featured']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" loading="lazy">
                        <?php else: ?>
                            &#128197;
                        <?php endif; ?>
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-date"><?= $dateDisplay ?><?php if (!empty($event['location'])): ?> &bull; <?= htmlspecialchars($event['location']) ?><?php endif; ?></div>
                        <h3><a href="/evenimente/<?= htmlspecialchars($event['slug']) ?>"><?= htmlspecialchars($event['title']) ?></a></h3>
                        <p class="blog-card-excerpt"><?= htmlspecialchars($event['description'] ?? '') ?></p>
                        <a href="/evenimente/<?= htmlspecialchars($event['slug']) ?>" class="read-more">Detalii eveniment &rarr;</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
