<?php
/** @var array $job */
/** @var array $otherJobs */
?>

<section class="section">
    <div class="container">
        <div class="blog-single-layout">
            <article class="blog-single-content">
                <header class="blog-single-header">
                    <div class="blog-card-date">
                        <?php if (!empty($job['location'])): ?>&#128205; <?= htmlspecialchars($job['location']) ?><?php endif; ?>
                        <?php if (!empty($job['type'])): ?> &bull; &#128337; <?= htmlspecialchars($job['type']) ?><?php endif; ?>
                    </div>
                    <h1><?= htmlspecialchars($job['title']) ?></h1>
                    <p class="blog-single-excerpt"><?= htmlspecialchars($job['description'] ?? '') ?></p>
                </header>

                <div class="blog-single-body">
                    <?php if (!empty($job['responsibilities'])): ?>
                    <h2>Responsabilitati</h2>
                    <ul>
                        <?php foreach (explode("\n", $job['responsibilities']) as $line): ?>
                            <?php if (trim($line)): ?><li><?= htmlspecialchars(trim($line)) ?></li><?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if (!empty($job['requirements'])): ?>
                    <h2>Cerinte</h2>
                    <ul>
                        <?php foreach (explode("\n", $job['requirements']) as $line): ?>
                            <?php if (trim($line)): ?><li><?= htmlspecialchars(trim($line)) ?></li><?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php if (!empty($job['benefits'])): ?>
                    <h2>Beneficii</h2>
                    <ul>
                        <?php foreach (explode("\n", $job['benefits']) as $line): ?>
                            <?php if (trim($line)): ?><li><?= htmlspecialchars(trim($line)) ?></li><?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <div class="job-apply-cta">
                        <h3>Aplica acum</h3>
                        <p>Trimite CV-ul tau la <a href="mailto:office@bdmacoperis.ro">office@bdmacoperis.ro</a> cu subiectul "<strong><?= htmlspecialchars($job['title']) ?></strong>".</p>
                        <a href="mailto:office@bdmacoperis.ro?subject=Aplicare%20-%20<?= rawurlencode($job['title']) ?>" class="btn btn-primary btn-lg">Trimite CV-ul</a>
                    </div>
                </div>
            </article>

            <?php if (!empty($otherJobs)): ?>
            <aside class="blog-sidebar">
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Alte pozitii disponibile</h3>
                    <?php foreach ($otherJobs as $oj): ?>
                        <a href="/cariere/<?= htmlspecialchars($oj['slug']) ?>" class="sidebar-popular-item">
                            <?= htmlspecialchars($oj['title']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </aside>
            <?php endif; ?>
        </div>
    </div>
</section>
