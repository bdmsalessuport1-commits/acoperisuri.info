<?php
$articles           = $articles           ?? [];
$featured           = $featured           ?? null;
$categories         = $categories         ?? [];
$popular            = $popular            ?? [];
$currentPage        = $currentPage        ?? 1;
$totalPages         = $totalPages         ?? 1;
$totalArticles      = $totalArticles      ?? 0;
$activeCategory     = $activeCategory     ?? null;
$activeCategoryName = $activeCategoryName ?? null;
?>

<!-- HERO -->
<section class="blog-hero">
    <div class="container">
        <?php if ($activeCategory): ?>
            <div class="blog-cat-badge"><?= htmlspecialchars($categories[array_search($activeCategory, array_column($categories, 'slug'))]['icon'] ?? '&#128196;') ?> Categorie</div>
            <h1><?= htmlspecialchars($activeCategoryName) ?></h1>
            <p class="blog-hero-desc"><?= $totalArticles ?> <?= $totalArticles === 1 ? 'articol' : 'articole' ?> in aceasta categorie</p>
        <?php else: ?>
            <h1>Blog - Ghiduri si articole utile</h1>
            <p class="blog-hero-desc">Sfaturi practice, ghiduri de montaj, comparatii de materiale si studii de caz pentru acoperisul tau.</p>
        <?php endif; ?>

        <!-- Category filter pills -->
        <div class="blog-pills">
            <a href="/blog" class="blog-pill <?= !$activeCategory ? 'active' : '' ?>">Toate</a>
            <?php foreach ($categories as $cat): ?>
            <a href="/blog/categorie/<?= htmlspecialchars($cat['slug']) ?>"
               class="blog-pill <?= $activeCategory === $cat['slug'] ? 'active' : '' ?>">
                <?= $cat['icon'] ?> <?= htmlspecialchars($cat['name']) ?>
                <span class="pill-count"><?= $cat['count'] ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CONTENT + SIDEBAR -->
<section class="section">
    <div class="container">
        <div class="blog-layout">

            <!-- MAIN CONTENT -->
            <div class="blog-content">

                <?php if (empty($articles) && !$featured): ?>
                <div class="page-placeholder" style="padding: var(--spacing-2xl) 0;">
                    <div class="placeholder-icon">&#128196;</div>
                    <h2>Niciun articol in aceasta categorie</h2>
                    <p>Revino curand pentru articole noi.</p>
                    <a href="/blog" class="btn btn-primary mt-lg">Toate articolele</a>
                </div>

                <?php else: ?>

                <!-- FEATURED ARTICLE (page 1 only, no category filter) -->
                <?php if ($featured): ?>
                <a href="/blog/<?= htmlspecialchars($featured['slug']) ?>" class="blog-featured">
                    <div class="blog-featured-img" style="background-color: <?= htmlspecialchars($featured['image_color']) ?>;">
                        <span><?= $featured['image_icon'] ?></span>
                    </div>
                    <div class="blog-featured-body">
                        <div class="blog-featured-meta">
                            <span class="blog-cat-label"><?= htmlspecialchars($featured['category_name']) ?></span>
                            <span class="blog-date">&#128197; <?= htmlspecialchars($featured['date_display']) ?></span>
                            <span class="blog-readtime">&#9201; <?= $featured['read_time'] ?> min</span>
                        </div>
                        <h2><?= htmlspecialchars($featured['title']) ?></h2>
                        <p class="blog-featured-excerpt"><?= htmlspecialchars($featured['excerpt']) ?></p>
                        <div class="blog-featured-footer">
                            <span class="blog-author">&#9998; <?= htmlspecialchars($featured['author']) ?></span>
                            <span class="blog-read-link">Citeste articolul &rarr;</span>
                        </div>
                    </div>
                </a>
                <?php endif; ?>

                <!-- ARTICLES GRID -->
                <?php if (!empty($articles)): ?>
                <div class="blog-grid">
                    <?php foreach ($articles as $art): ?>
                    <a href="/blog/<?= htmlspecialchars($art['slug']) ?>" class="blog-card">
                        <div class="blog-card-img" style="background-color: <?= htmlspecialchars($art['image_color']) ?>;">
                            <span><?= $art['image_icon'] ?></span>
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-card-meta">
                                <span class="blog-cat-label"><?= htmlspecialchars($art['category_name']) ?></span>
                                <span class="blog-readtime">&#9201; <?= $art['read_time'] ?> min</span>
                            </div>
                            <h3><?= htmlspecialchars($art['title']) ?></h3>
                            <p class="blog-card-excerpt"><?= htmlspecialchars(mb_substr($art['excerpt'], 0, 150)) ?><?= mb_strlen($art['excerpt']) > 150 ? '...' : '' ?></p>
                            <div class="blog-card-footer">
                                <span class="blog-date">&#128197; <?= htmlspecialchars($art['date_display']) ?></span>
                                <span class="blog-read-link">Citeste &rarr;</span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- PAGINATION -->
                <?php if ($totalPages > 1): ?>
                <div class="blog-pagination">
                    <?php if ($currentPage > 1): ?>
                    <a href="?pagina=<?= $currentPage - 1 ?>" class="page-btn">&larr; Anterioara</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?pagina=<?= $i ?>" class="page-btn <?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                    <a href="?pagina=<?= $currentPage + 1 ?>" class="page-btn">Urmatoarea &rarr;</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php endif; // end not empty ?>
            </div>

            <!-- SIDEBAR -->
            <aside class="blog-sidebar">

                <!-- Categorii -->
                <div class="sidebar-box">
                    <h4>Categorii</h4>
                    <div class="sidebar-links">
                        <?php foreach ($categories as $cat): ?>
                        <a href="/blog/categorie/<?= htmlspecialchars($cat['slug']) ?>"
                           <?= $activeCategory === $cat['slug'] ? 'class="active-sub"' : '' ?>>
                            <span><?= $cat['icon'] ?> <?= htmlspecialchars($cat['name']) ?></span>
                            <span class="sidebar-count"><?= $cat['count'] ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Articole populare -->
                <?php if (!empty($popular)): ?>
                <div class="sidebar-box">
                    <h4>Articole populare</h4>
                    <div class="sidebar-popular">
                        <?php foreach ($popular as $pop): ?>
                        <a href="/blog/<?= htmlspecialchars($pop['slug']) ?>" class="popular-article">
                            <div class="popular-art-icon" style="background-color: <?= htmlspecialchars($pop['image_color']) ?>;"><?= $pop['image_icon'] ?></div>
                            <div class="popular-art-info">
                                <span class="popular-art-cat"><?= htmlspecialchars($pop['category_name']) ?></span>
                                <span class="popular-art-title"><?= htmlspecialchars(mb_substr($pop['title'], 0, 60)) ?><?= mb_strlen($pop['title']) > 60 ? '...' : '' ?></span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- CTA -->
                <div class="sidebar-box sidebar-cta">
                    <h4>Consultanta gratuita</h4>
                    <p>Expertii nostri va ajuta sa alegeti solutiile potrivite pentru proiectul dumneavoastra.</p>
                    <a href="tel:+40756034734" class="btn btn-accent">&#128222; Suna acum</a>
                </div>

            </aside>
        </div>
    </div>
</section>
