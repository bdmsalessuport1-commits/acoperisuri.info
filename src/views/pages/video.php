<?php
$videos             = $videos             ?? [];
$categories         = $categories         ?? [];
$activeCategory     = $activeCategory     ?? null;
$activeSubcategory  = $activeSubcategory  ?? null;
$activeCategoryName = $activeCategoryName ?? null;
$totalVideos        = $totalVideos        ?? 0;

// Build lookups: slug → name
$catNames = [];
$subNames = [];
foreach ($categories as $cat) {
    $catNames[$cat['slug']] = $cat['name'];
    foreach ($cat['subcategories'] ?? [] as $sub) {
        $subNames[$sub['slug']] = $sub['name'];
    }
}
?>

<!-- HERO -->
<section class="video-hero">
    <div class="container">
        <?php if ($activeCategoryName): ?>
            <div class="video-hero-badge"><?= htmlspecialchars($activeCategoryName) ?></div>
            <h1><?= htmlspecialchars($activeCategoryName) ?> - Videouri</h1>
            <p class="video-hero-desc"><?= $totalVideos ?> <?= $totalVideos === 1 ? 'video' : 'videouri' ?> in aceasta categorie.</p>
        <?php else: ?>
            <h1>Videouri - Sfaturi si demonstratii</h1>
            <p class="video-hero-desc">Urmariti-ne pe TikTok pentru cele mai noi videouri despre acoperisuri si constructii.</p>
        <?php endif; ?>

        <!-- Category pills -->
        <div class="video-pills">
            <a href="/video" class="video-pill <?= !$activeCategory && !$activeSubcategory ? 'active' : '' ?>">
                Toate
            </a>
            <?php foreach ($categories as $cat): ?>
            <a href="/video/categorie/<?= htmlspecialchars($cat['slug']) ?>"
               class="video-pill <?= $activeCategory === $cat['slug'] ? 'active' : '' ?>">
                <?= $cat['icon'] ?> <?= htmlspecialchars($cat['name']) ?>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Subcategory pills (when a main category is active) -->
        <?php if ($activeCategory): ?>
        <?php
            $activeCatData = null;
            foreach ($categories as $cat) {
                if ($cat['slug'] === $activeCategory) { $activeCatData = $cat; break; }
            }
        ?>
        <?php if ($activeCatData && !empty($activeCatData['subcategories'])): ?>
        <div class="video-subpills">
            <a href="/video/categorie/<?= htmlspecialchars($activeCategory) ?>"
               class="video-subpill <?= !$activeSubcategory ? 'active' : '' ?>">Toate</a>
            <?php foreach ($activeCatData['subcategories'] as $sub): ?>
            <a href="/video/categorie/<?= htmlspecialchars($sub['slug']) ?>"
               class="video-subpill <?= $activeSubcategory === $sub['slug'] ? 'active' : '' ?>">
                <?= htmlspecialchars($sub['name']) ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- CONTENT -->
<section class="section">
    <div class="container">

        <?php if (empty($videos)): ?>
        <div class="page-placeholder" style="padding: var(--spacing-3xl) 0;">
            <div class="placeholder-icon">&#127909;</div>
            <h2>Niciun video in aceasta categorie</h2>
            <p>Revino curand pentru videouri noi.</p>
            <a href="/video" class="btn btn-primary mt-lg">Toate videouri</a>
        </div>

        <?php else: ?>

        <!-- VIDEO GRID -->
        <div class="video-grid">
            <?php foreach ($videos as $v): ?>
            <div class="video-card">

                <!-- Embed placeholder (lazy loaded) -->
                <div class="video-embed-wrapper" id="embed-<?= htmlspecialchars($v['tiktok_id']) ?>">
                    <div class="video-placeholder"
                         data-tiktok-url="<?= htmlspecialchars($v['tiktok_url']) ?>"
                         data-tiktok-id="<?= htmlspecialchars($v['tiktok_id']) ?>">
                        <div class="video-placeholder-bg">
                            <span class="video-play-icon">&#9654;</span>
                            <span class="video-tiktok-badge">TikTok</span>
                        </div>
                        <button class="video-load-btn" type="button">&#9654; Incarca videoul</button>
                    </div>
                </div>

                <!-- Card body -->
                <div class="video-card-body">
                    <div class="video-card-meta">
                        <span class="video-cat-label"><?= htmlspecialchars($catNames[$v['category_slug']] ?? '') ?></span>
                        <?php if (!empty($v['subcategory_slug']) && isset($subNames[$v['subcategory_slug']])): ?>
                        <span class="video-sub-label"><?= htmlspecialchars($subNames[$v['subcategory_slug']]) ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="video-card-title"><?= htmlspecialchars($v['title']) ?></h3>
                    <p class="video-card-desc"><?= htmlspecialchars($v['description']) ?></p>
                    <div class="video-card-footer">
                        <span class="video-date">&#128197; <?= htmlspecialchars($v['date_display']) ?></span>
                        <a href="<?= htmlspecialchars($v['tiktok_url']) ?>" target="_blank" rel="noopener" class="video-tiktok-link">
                            &#127911; Vezi pe TikTok
                        </a>
                    </div>
                </div>

                <!-- Schema.org VideoObject -->
                <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "VideoObject",
                    "name": "<?= addslashes(htmlspecialchars($v['title'])) ?>",
                    "description": "<?= addslashes(htmlspecialchars($v['description'])) ?>",
                    "uploadDate": "<?= htmlspecialchars($v['published_at']) ?>",
                    "contentUrl": "<?= htmlspecialchars($v['tiktok_url']) ?>",
                    "thumbnailUrl": "https://acoperisuri.info/images/logo/logo-full.png",
                    "publisher": {
                        "@type": "Organization",
                        "name": "BDM Systems",
                        "logo": {
                            "@type": "ImageObject",
                            "url": "https://acoperisuri.info/images/logo/logo-full.png"
                        }
                    }
                }
                </script>
            </div>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>

        <!-- CTA -->
        <div class="video-cta-section">
            <div class="video-cta-box">
                <div class="video-cta-content">
                    <h3>&#127911; Urmariti-ne pe TikTok</h3>
                    <p>Publicam regulat videouri noi cu sfaturi de montaj, prezentari de produse si proiecte finalizate.</p>
                </div>
                <div class="video-cta-actions">
                    <a href="https://www.tiktok.com/@bdmsystems" target="_blank" rel="noopener" class="btn btn-primary">
                        Urmareste pe TikTok
                    </a>
                    <a href="/contact" class="btn btn-outline">Solicita oferta</a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Lazy Load TikTok Embeds -->
<script>
(function () {
    var sdkLoaded = false;

    function loadTikTokSDK(cb) {
        if (sdkLoaded) { cb(); return; }
        var s = document.createElement('script');
        s.src = 'https://www.tiktok.com/embed.js';
        s.async = true;
        s.onload = function () { sdkLoaded = true; cb(); };
        s.onerror = function () { /* SDK fail — fallback stays */ };
        document.body.appendChild(s);
    }

    function embedVideo(placeholder) {
        var id  = placeholder.getAttribute('data-tiktok-id');
        var url = placeholder.getAttribute('data-tiktok-url');
        var wrapper = placeholder.parentElement;

        var bq = document.createElement('blockquote');
        bq.className = 'tiktok-embed';
        bq.setAttribute('cite', url);
        bq.setAttribute('data-video-id', id);
        bq.style.maxWidth = '100%';
        bq.style.minWidth = '100%';

        var section = document.createElement('section');
        var a = document.createElement('a');
        a.href = url;
        a.target = '_blank';
        a.rel = 'noopener';
        a.textContent = 'Video pe TikTok';
        section.appendChild(a);
        bq.appendChild(section);

        wrapper.innerHTML = '';
        wrapper.appendChild(bq);

        loadTikTokSDK(function () {
            if (window.tiktokEmbed && window.tiktokEmbed.lib) {
                window.tiktokEmbed.lib.render();
            }
        });
    }

    // Click to load
    document.querySelectorAll('.video-load-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            var ph = btn.closest('.video-placeholder');
            if (ph) embedVideo(ph);
        });
    });

    // Intersection Observer — lazy load when visible
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var ph = entry.target.querySelector('.video-placeholder');
                    if (ph) embedVideo(ph);
                    observer.unobserve(entry.target);
                }
            });
        }, { rootMargin: '300px' });

        document.querySelectorAll('.video-embed-wrapper').forEach(function (el) {
            observer.observe(el);
        });
    }
})();
</script>
