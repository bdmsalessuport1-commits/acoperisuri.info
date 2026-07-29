<?php
/**
 * Dashboard Admin — statistici reale din datele aplicatiei
 * Variabile: $stats, $recentArticles, $recentVideos, $adminUser
 */
?>

<!-- STATS -->
<div class="dash-stats">
    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background: #ecfdf5; color: #065f46;">&#9776;</div>
        <div class="dash-stat-info">
            <span class="dash-stat-number"><?= $stats['categories'] ?? 0 ?></span>
            <span class="dash-stat-label">Categorii</span>
        </div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background: #eff6ff; color: #1e40af;">&#9733;</div>
        <div class="dash-stat-info">
            <span class="dash-stat-number"><?= $stats['products'] ?? 0 ?></span>
            <span class="dash-stat-label">Produse</span>
        </div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background: #fefce8; color: #854d0e;">&#9998;</div>
        <div class="dash-stat-info">
            <span class="dash-stat-number"><?= $stats['articles'] ?? 0 ?></span>
            <span class="dash-stat-label">Articole blog</span>
        </div>
    </div>

    <div class="dash-stat-card">
        <div class="dash-stat-icon" style="background: #fdf2f8; color: #9d174d;">&#9654;</div>
        <div class="dash-stat-info">
            <span class="dash-stat-number"><?= $stats['videos'] ?? 0 ?></span>
            <span class="dash-stat-label">Videouri</span>
        </div>
    </div>
</div>

<!-- GRID 2 COLUMNS -->
<div class="dash-grid">

    <!-- Ultimele articole -->
    <div class="dash-card">
        <div class="dash-card-header">
            <span class="dash-card-title">Ultimele articole</span>
            <a href="/admin/blog" class="dash-card-link">Vezi toate &rarr;</a>
        </div>
        <div class="dash-card-body">
            <?php if (!empty($recentArticles)): ?>
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Titlu</th>
                            <th>Data</th>
                            <th>Categorie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentArticles as $article): ?>
                            <tr>
                                <td><a href="/blog/<?= $article['slug'] ?>" target="_blank"><?= htmlspecialchars(mb_strimwidth($article['title'], 0, 45, '...')) ?></a></td>
                                <td><?= date('d.m.Y', strtotime($article['date'])) ?></td>
                                <td><span class="badge badge-blue"><?= htmlspecialchars($article['category_name']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="dash-empty">Niciun articol momentan.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Ultimele videouri -->
    <div class="dash-card">
        <div class="dash-card-header">
            <span class="dash-card-title">Ultimele videouri</span>
            <a href="/admin/videouri" class="dash-card-link">Vezi toate &rarr;</a>
        </div>
        <div class="dash-card-body">
            <?php if (!empty($recentVideos)): ?>
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Titlu</th>
                            <th>Data</th>
                            <th>Categorie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentVideos as $video): ?>
                            <tr>
                                <td><?= htmlspecialchars(mb_strimwidth($video['title'], 0, 45, '...')) ?></td>
                                <td><?= date('d.m.Y', strtotime($video['published_at'])) ?></td>
                                <td><span class="badge badge-green"><?= htmlspecialchars($video['category_slug']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="dash-empty">Niciun video momentan.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mesaje / Lead-uri -->
    <div class="dash-card">
        <div class="dash-card-header">
            <span class="dash-card-title">Mesaje / Lead-uri</span>
            <a href="/admin/mesaje" class="dash-card-link">Vezi toate &rarr;</a>
        </div>
        <div class="dash-card-body">
            <div class="dash-empty">
                Formularul de contact va salva mesajele in baza de date (Etapa 18).<br>
                <span class="badge badge-orange" style="margin-top: 8px; display: inline-block;">In dezvoltare</span>
            </div>
        </div>
    </div>

    <!-- Status site -->
    <div class="dash-card">
        <div class="dash-card-header">
            <span class="dash-card-title">Status site</span>
        </div>
        <div class="dash-card-body">
            <div class="dash-status-list">
                <div class="dash-status-row">
                    <span class="dash-status-label">PHP</span>
                    <span class="dash-status-value"><?= PHP_VERSION ?></span>
                </div>
                <div class="dash-status-row">
                    <span class="dash-status-label">Mediu</span>
                    <span class="dash-status-value"><?= htmlspecialchars(\App\Helpers\Env::get('APP_ENV', 'development')) ?></span>
                </div>
                <div class="dash-status-row">
                    <span class="dash-status-label">Utilizator</span>
                    <span class="dash-status-value"><?= htmlspecialchars($adminUser['name'] ?? '-') ?></span>
                </div>
                <div class="dash-status-row">
                    <span class="dash-status-label">Rol</span>
                    <span class="dash-status-value"><span class="badge badge-green"><?= htmlspecialchars(ucfirst($adminUser['role'] ?? '-')) ?></span></span>
                </div>
                <div class="dash-status-row">
                    <span class="dash-status-label">Sesiune</span>
                    <span class="dash-status-value"><?= date('H:i, d.m.Y', $_SESSION['admin_login_time'] ?? time()) ?></span>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- QUICK ACTIONS -->
<div style="margin-top: var(--spacing-xl);">
    <div class="dash-card">
        <div class="dash-card-header">
            <span class="dash-card-title">Actiuni rapide</span>
        </div>
        <div class="dash-card-body">
            <div class="dash-actions">
                <a href="/admin/produse" class="dash-action-btn">&#9733; Adauga produs</a>
                <a href="/admin/blog" class="dash-action-btn">&#9998; Articol nou</a>
                <a href="/admin/videouri" class="dash-action-btn">&#9654; Adauga video</a>
                <a href="/admin/mesaje" class="dash-action-btn">&#9993; Mesaje</a>
                <a href="/admin/seo" class="dash-action-btn">&#9906; SEO</a>
                <a href="/" class="dash-action-btn" target="_blank">&#8599; Vezi site-ul</a>
            </div>
        </div>
    </div>
</div>
