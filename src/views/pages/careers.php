<?php /** @var array $jobs */ ?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1>Cariere la BDM Systems</h1>
            <p>Alatura-te echipei noastre de profesionisti. Construim impreuna viitorul.</p>
        </div>

        <?php if (empty($jobs)): ?>
            <div class="page-placeholder">
                <div class="placeholder-icon">&#128188;</div>
                <h2>Niciun post disponibil momentan</h2>
                <p>Reveniti curand sau trimiteti un CV la <a href="mailto:office@bdmacoperis.ro">office@bdmacoperis.ro</a>.</p>
            </div>
        <?php else: ?>
            <div class="jobs-list">
                <?php foreach ($jobs as $job): ?>
                <a href="/cariere/<?= htmlspecialchars($job['slug']) ?>" class="job-card">
                    <div class="job-card-main">
                        <h3><?= htmlspecialchars($job['title']) ?></h3>
                        <p><?= htmlspecialchars($job['description'] ?? '') ?></p>
                    </div>
                    <div class="job-card-meta">
                        <?php if (!empty($job['location'])): ?>
                            <span class="job-meta-item">&#128205; <?= htmlspecialchars($job['location']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($job['type'])): ?>
                            <span class="job-meta-item">&#128337; <?= htmlspecialchars($job['type']) ?></span>
                        <?php endif; ?>
                    </div>
                    <span class="job-card-arrow">&#10095;</span>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-xl">
                <p class="text-light">Nu gasesti pozitia potrivita? Trimite-ne CV-ul la <a href="mailto:office@bdmacoperis.ro">office@bdmacoperis.ro</a></p>
            </div>
        <?php endif; ?>
    </div>
</section>
