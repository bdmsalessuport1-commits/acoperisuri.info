<?php
$article        = $article        ?? [];
$relatedArticles= $relatedArticles?? [];
$popular        = $popular        ?? [];
$categories     = $categories     ?? [];

$title    = $article['title']        ?? '';
$excerpt  = $article['excerpt']      ?? '';
$content  = $article['content']      ?? '';
$date     = $article['date']         ?? '';
$dateDisp = $article['date_display'] ?? '';
$author   = $article['author']       ?? 'Echipa BDM Systems';
$catName  = $article['category_name']?? '';
$catSlug  = $article['category_slug']?? '';
$readTime = $article['read_time']    ?? 5;
$imgIcon  = $article['image_icon']   ?? '&#128196;';
$imgColor = $article['image_color']  ?? '#1a4a7a';
$tags     = $article['tags']         ?? [];
$relProds = $article['related_products'] ?? [];
?>

<!-- Schema.org Article -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?= addslashes(htmlspecialchars($title)) ?>",
    "description": "<?= addslashes(htmlspecialchars($excerpt)) ?>",
    "datePublished": "<?= htmlspecialchars($date) ?>",
    "dateModified": "<?= htmlspecialchars($date) ?>",
    "author": {
        "@type": "Person",
        "name": "<?= htmlspecialchars($author) ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "BDM Systems",
        "logo": {
            "@type": "ImageObject",
            "url": "https://acoperisuri.info/images/logo/logo-full.png"
        }
    },
    "image": "https://acoperisuri.info/images/logo/logo-full.png",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://acoperisuri.info/blog/<?= htmlspecialchars($article['slug'] ?? '') ?>"
    }
}
</script>

<!-- ARTICLE HERO -->
<section class="article-hero">
    <div class="container">
        <div class="article-hero-meta">
            <a href="/blog/categorie/<?= htmlspecialchars($catSlug) ?>" class="article-cat-badge"><?= htmlspecialchars($catName) ?></a>
            <span class="article-date">&#128197; <?= htmlspecialchars($dateDisp) ?></span>
            <span class="article-author">&#9998; <?= htmlspecialchars($author) ?></span>
            <span class="article-readtime">&#9201; <?= $readTime ?> min citire</span>
        </div>
        <h1><?= htmlspecialchars($title) ?></h1>
        <p class="article-hero-excerpt"><?= htmlspecialchars($excerpt) ?></p>
        <div class="article-hero-img" style="background-color: <?= htmlspecialchars($imgColor) ?>;">
            <span><?= $imgIcon ?></span>
        </div>
    </div>
</section>

<!-- ARTICLE CONTENT + SIDEBAR -->
<section class="section">
    <div class="container">
        <div class="article-layout">

            <!-- ARTICLE BODY -->
            <article class="article-content" id="article-body">

                <?= $content ?>

                <!-- Tags -->
                <?php if (!empty($tags)): ?>
                <div class="article-tags">
                    <span class="tags-label">&#127991; Etichete:</span>
                    <?php foreach ($tags as $tag): ?>
                    <span class="article-tag"><?= htmlspecialchars($tag) ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Related products -->
                <?php if (!empty($relProds)): ?>
                <div class="article-related-products">
                    <h3>&#128270; Produse mentionate in acest articol</h3>
                    <div class="article-prod-grid">
                        <?php foreach ($relProds as $prod): ?>
                        <a href="/produs/<?= htmlspecialchars($prod['slug']) ?>" class="article-prod-card">
                            <span class="article-prod-icon">&#9650;</span>
                            <span class="article-prod-name"><?= htmlspecialchars($prod['name']) ?></span>
                            <span class="article-prod-link">Vezi produs &rarr;</span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Share / navigation -->
                <div class="article-footer-nav">
                    <a href="/blog" class="btn btn-outline">&larr; Inapoi la blog</a>
                    <a href="/contact" class="btn btn-primary">Solicita oferta</a>
                </div>

            </article>

            <!-- SIDEBAR -->
            <aside class="blog-sidebar article-sidebar">

                <!-- Table of Contents (JS populated) -->
                <div class="sidebar-box" id="toc-box">
                    <h4>&#128220; Cuprins</h4>
                    <nav id="article-toc" class="article-toc">
                        <!-- Populated by JS -->
                    </nav>
                </div>

                <!-- Popular articles -->
                <?php if (!empty($popular)): ?>
                <div class="sidebar-box">
                    <h4>Articole populare</h4>
                    <div class="sidebar-popular">
                        <?php foreach ($popular as $pop): ?>
                        <?php if (($pop['slug'] ?? '') === ($article['slug'] ?? '')) continue; ?>
                        <a href="/blog/<?= htmlspecialchars($pop['slug']) ?>" class="popular-article">
                            <div class="popular-art-icon" style="background-color: <?= htmlspecialchars($pop['image_color']) ?>;"><?= $pop['image_icon'] ?></div>
                            <div class="popular-art-info">
                                <span class="popular-art-cat"><?= htmlspecialchars($pop['category_name']) ?></span>
                                <span class="popular-art-title"><?= htmlspecialchars(mb_substr($pop['title'], 0, 55)) ?><?= mb_strlen($pop['title']) > 55 ? '...' : '' ?></span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Categorii -->
                <div class="sidebar-box">
                    <h4>Categorii</h4>
                    <div class="sidebar-links">
                        <?php foreach ($categories as $cat): ?>
                        <a href="/blog/categorie/<?= htmlspecialchars($cat['slug']) ?>"
                           <?= $catSlug === $cat['slug'] ? 'class="active-sub"' : '' ?>>
                            <span><?= $cat['icon'] ?> <?= htmlspecialchars($cat['name']) ?></span>
                            <span class="sidebar-count"><?= $cat['count'] ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- CTA -->
                <div class="sidebar-box sidebar-cta">
                    <h4>Consultanta gratuita</h4>
                    <p>Expertii nostri va ajuta cu orice intrebare legata de acoperis.</p>
                    <a href="tel:+40756034734" class="btn btn-accent">&#128222; Suna acum</a>
                </div>

            </aside>
        </div>

        <!-- RELATED ARTICLES (bottom) -->
        <?php if (!empty($relatedArticles)): ?>
        <div class="related-articles-section">
            <h2 class="related-articles-title">Articole similare</h2>
            <div class="related-articles-grid">
                <?php foreach ($relatedArticles as $rel): ?>
                <a href="/blog/<?= htmlspecialchars($rel['slug']) ?>" class="blog-card">
                    <div class="blog-card-img" style="background-color: <?= htmlspecialchars($rel['image_color']) ?>;">
                        <span><?= $rel['image_icon'] ?></span>
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-meta">
                            <span class="blog-cat-label"><?= htmlspecialchars($rel['category_name']) ?></span>
                            <span class="blog-readtime">&#9201; <?= $rel['read_time'] ?> min</span>
                        </div>
                        <h3><?= htmlspecialchars($rel['title']) ?></h3>
                        <p class="blog-card-excerpt"><?= htmlspecialchars(mb_substr($rel['excerpt'], 0, 120)) ?>...</p>
                        <div class="blog-card-footer">
                            <span class="blog-date">&#128197; <?= htmlspecialchars($rel['date_display']) ?></span>
                            <span class="blog-read-link">Citeste &rarr;</span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- ToC + Scroll Spy Script -->
<script>
(function () {
    const content = document.getElementById('article-body');
    const toc     = document.getElementById('article-toc');
    const tocBox  = document.getElementById('toc-box');
    if (!content || !toc) return;

    const headings = content.querySelectorAll('h2, h3');
    if (headings.length === 0) { if (tocBox) tocBox.style.display = 'none'; return; }

    const ul = document.createElement('ul');
    ul.className = 'toc-list';

    headings.forEach(function (h) {
        // Ensure heading has an id
        if (!h.id) {
            h.id = h.textContent.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim().replace(/\s+/g, '-');
        }
        const li = document.createElement('li');
        li.className = h.tagName === 'H3' ? 'toc-item toc-sub' : 'toc-item';
        const a = document.createElement('a');
        a.href = '#' + h.id;
        a.textContent = h.textContent;
        a.className = 'toc-link';
        li.appendChild(a);
        ul.appendChild(li);
    });

    toc.appendChild(ul);

    // Scroll spy
    const links = toc.querySelectorAll('.toc-link');
    window.addEventListener('scroll', function () {
        let current = '';
        headings.forEach(function (h) {
            if (window.scrollY >= h.offsetTop - 120) current = h.id;
        });
        links.forEach(function (a) {
            a.classList.toggle('toc-active', a.getAttribute('href') === '#' + current);
        });
    }, { passive: true });
})();
</script>
