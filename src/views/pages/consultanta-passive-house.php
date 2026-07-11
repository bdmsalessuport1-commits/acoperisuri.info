<?php
/**
 * Landing page — Consultanță Passive House
 *
 * Variabile primite:
 *   $content            — array cu tot conținutul (din src/config/consultanta-content.php)
 *   $preselectedPackage — string (analiza|optimizare|completa|nu-stiu|'')
 *   $formData           — array (state formular la eroare)
 *   $formErrors         — array (cheie => mesaj)
 */
$c = $content;
$fd = $formData ?? [];
$fe = $formErrors ?? [];
$preselected = $preselectedPackage ?? '';
$hasErrors = !empty($fe);
?>

<link rel="stylesheet" href="/css/consulting.css?v=1">

<!-- ═════════════════════════════════════════════════════════════════
     1. HERO
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-hero" id="hero">
    <div class="ch-hero-bg" aria-hidden="true">
        <svg class="ch-hero-lines" viewBox="0 0 1440 800" preserveAspectRatio="xMidYMid slice">
            <defs>
                <linearGradient id="chLineGrad" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0" stop-color="#12A757" stop-opacity=".18"/>
                    <stop offset="1" stop-color="#14A4D4" stop-opacity="0"/>
                </linearGradient>
            </defs>
            <path d="M-50,650 L400,450 L800,600 L1200,400 L1490,550" stroke="url(#chLineGrad)" stroke-width="1.5" fill="none"/>
            <path d="M-50,700 L500,520 L900,650 L1300,470 L1490,600" stroke="url(#chLineGrad)" stroke-width="1" fill="none"/>
            <path d="M-50,750 L600,590 L1000,700 L1490,530" stroke="url(#chLineGrad)" stroke-width=".75" fill="none"/>
        </svg>
    </div>

    <div class="container">
        <div class="ch-hero-grid">

            <div class="ch-hero-text">
                <div class="ch-hero-eyebrow">
                    <span class="ch-eyebrow-dot"></span>
                    <?= htmlspecialchars($c['expert']['subtitle']) ?>
                </div>

                <h1 class="ch-hero-h1"><?= htmlspecialchars($c['hero']['headline']) ?></h1>
                <p class="ch-hero-sub"><?= htmlspecialchars($c['hero']['subheadline']) ?></p>

                <ul class="ch-trust-badges">
                    <?php foreach ($c['hero']['trust_badges'] as $badge): ?>
                        <li>
                            <svg class="ch-icon-check" viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10.5l4 4 8-9" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <?= htmlspecialchars($badge) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="ch-hero-ctas">
                    <a href="<?= htmlspecialchars($c['hero']['cta_primary']['url']) ?>"
                       class="ch-btn ch-btn-primary"
                       data-analytics="hero_cta_primary_click">
                        <?= htmlspecialchars($c['hero']['cta_primary']['label']) ?>
                        <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="<?= htmlspecialchars($c['hero']['cta_secondary']['url']) ?>"
                       class="ch-btn ch-btn-ghost"
                       data-analytics="hero_cta_secondary_click">
                        <?= htmlspecialchars($c['hero']['cta_secondary']['label']) ?>
                    </a>
                </div>

                <p class="ch-hero-note"><?= htmlspecialchars($c['hero']['cta_note']) ?></p>
            </div>

            <div class="ch-hero-visual">
                <div class="ch-portrait-frame">
                    <div class="ch-portrait-accent" aria-hidden="true"></div>
                    <img src="<?= htmlspecialchars($c['hero']['image']) ?>"
                         alt="<?= htmlspecialchars($c['hero']['image_alt']) ?>"
                         class="ch-portrait"
                         width="480" height="600"
                         fetchpriority="high"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="ch-portrait-fallback" style="display:none;" aria-hidden="true">
                        <svg viewBox="0 0 200 250" width="180" height="220"><rect width="200" height="250" fill="#F0F4F8" rx="12"/><circle cx="100" cy="90" r="35" fill="#D0D5DD"/><path d="M40 220 Q40 160 100 160 Q160 160 160 220 Z" fill="#D0D5DD"/><text x="100" y="245" text-anchor="middle" font-size="10" fill="#7A7A7A" font-family="sans-serif">Foto Mircea Barticel</text></svg>
                    </div>

                    <div class="ch-cert-stack">
                        <?php foreach ($c['expert']['certifications'] as $cert): ?>
                            <a href="<?= htmlspecialchars($cert['pdf']) ?>"
                               target="_blank" rel="noopener"
                               class="ch-cert-mini"
                               data-analytics="certificate_pdf_click"
                               data-cert="<?= htmlspecialchars($cert['code']) ?>"
                               title="<?= htmlspecialchars($cert['name']) ?> — deschide PDF-ul certificatului">
                                <div class="ch-cert-mini-icon"><?= htmlspecialchars($cert['code']) ?></div>
                                <div class="ch-cert-mini-txt">
                                    <div class="ch-cert-mini-t"><?= htmlspecialchars($cert['name']) ?></div>
                                    <div class="ch-cert-mini-s">PHI · Darmstadt</div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     2. AUTORITATE
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-authority" id="autoritate">
    <div class="container">
        <div class="ch-section-head ch-center">
            <p class="ch-eyebrow"><?= htmlspecialchars($c['authority']['lead']) ?></p>
            <h2><?= htmlspecialchars($c['authority']['headline']) ?></h2>
        </div>

        <div class="ch-cert-grid">
            <?php foreach ($c['expert']['certifications'] as $cert): ?>
                <div class="ch-cert-card">
                    <div class="ch-cert-badge">
                        <img src="<?= htmlspecialchars($cert['badge']) ?>"
                             alt="<?= htmlspecialchars($cert['name']) ?> — insignă oficială eliberată de <?= htmlspecialchars($cert['issuer']) ?>"
                             width="180" height="180"
                             loading="lazy">
                    </div>
                    <h3><?= htmlspecialchars($cert['name']) ?></h3>
                    <p class="ch-cert-issuer">Emis de <?= htmlspecialchars($cert['issuer']) ?></p>
                    <a href="<?= htmlspecialchars($cert['pdf']) ?>"
                       target="_blank" rel="noopener"
                       class="ch-cert-link"
                       data-analytics="certificate_pdf_click">
                        Vezi certificatul (PDF)
                        <svg viewBox="0 0 20 20" width="14" height="14" aria-hidden="true"><path d="M6 4h10v10M6 14L16 4M4 8v8h8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </a>
                </div>
            <?php endforeach; ?>

            <div class="ch-cert-card ch-cert-card-company">
                <div class="ch-company-logo">
                    <img src="/images/logo/logo-full.png" alt="BDM Systems logo" height="48" width="176">
                </div>
                <h3>BDM Systems — trei divizii, o singură anvelopă</h3>
                <ul class="ch-divisions">
                    <?php foreach ($c['expert']['divisions'] as $d): ?>
                        <li><strong><?= htmlspecialchars($d['name']) ?></strong> — <?= htmlspecialchars($d['note']) ?></li>
                    <?php endforeach; ?>
                </ul>
                <p class="ch-company-note"><?= $c['authority']['body'] // safe: constant HTML with strong tags ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     3. PROBLEMA
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-problem" id="problema">
    <div class="container">
        <div class="ch-section-head">
            <span class="ch-eyebrow ch-eyebrow-red">Problema pe care o rezolvăm</span>
            <h2><?= htmlspecialchars($c['problem']['headline']) ?></h2>
        </div>
        <div class="ch-problem-body">
            <?php foreach ($c['problem']['body'] as $p): ?>
                <p><?= $p // safe: constant HTML with strong tags ?></p>
            <?php endforeach; ?>
            <div class="ch-callout">
                <svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" class="ch-callout-icon"><path d="M12 2l10 18H2z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M12 9v5M12 17v.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <p><?= htmlspecialchars($c['problem']['callout']) ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     4. COSTUL REAL
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-cost" id="cost">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Ideea centrală</span>
            <h2><?= htmlspecialchars($c['total_cost']['headline']) ?></h2>
            <p class="ch-lead"><?= $c['total_cost']['lead'] // safe: constant HTML with em tag ?></p>
        </div>

        <div class="ch-cost-formula">
            <div class="ch-cost-formula-label"><?= htmlspecialchars($c['total_cost']['formula']['label']) ?></div>
            <div class="ch-cost-parts">
                <?php foreach ($c['total_cost']['formula']['parts'] as $i => $part): ?>
                    <?php if ($i > 0): ?>
                        <div class="ch-cost-plus" aria-hidden="true">+</div>
                    <?php endif; ?>
                    <div class="ch-cost-part ch-cost-part-<?= $i ?>">
                        <div class="ch-cost-part-block" aria-hidden="true"></div>
                        <div class="ch-cost-part-label"><?= htmlspecialchars($part['label']) ?></div>
                        <div class="ch-cost-part-note"><?= htmlspecialchars($part['note']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="ch-cost-reduces">
            <h3>Consultanța reduce:</h3>
            <ul class="ch-reduces-list">
                <?php foreach ($c['total_cost']['reduces'] as $r): ?>
                    <li>
                        <svg class="ch-icon-minus" viewBox="0 0 20 20" aria-hidden="true"><circle cx="10" cy="10" r="9" fill="#12A757"/><path d="M6 10h8" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                        <?= htmlspecialchars($r) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <p class="ch-disclaimer"><?= htmlspecialchars($c['total_cost']['disclaimer']) ?></p>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     5. CASA SE CONSTRUIEȘTE DE 3 ORI
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-three" id="trei-ori">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Un principiu al construcțiilor bune</span>
            <h2><?= htmlspecialchars($c['three_times']['headline']) ?></h2>
            <p class="ch-lead"><?= htmlspecialchars($c['three_times']['lead']) ?></p>
        </div>

        <div class="ch-three-stages">
            <?php foreach ($c['three_times']['stages'] as $s): ?>
                <div class="ch-stage <?= !empty($s['highlight']) ? 'ch-stage-highlight' : '' ?>">
                    <div class="ch-stage-num" aria-hidden="true"><?= htmlspecialchars($s['number']) ?></div>
                    <div class="ch-stage-icon" aria-hidden="true">
                        <?php if ($s['icon'] === 'brain'): ?>
                            <svg viewBox="0 0 48 48" width="40" height="40"><path d="M16 12c-4 0-7 3-7 7 0 2 1 4 2 5-1 1-2 3-2 5s1 4 3 5c0 3 3 6 6 6h1V12h-3zm16 0h-3v28h1c3 0 6-3 6-6 2-1 3-3 3-5s-1-4-2-5c1-1 2-3 2-5 0-4-3-7-7-7z" fill="none" stroke="currentColor" stroke-width="1.8"/></svg>
                        <?php elseif ($s['icon'] === 'plans'): ?>
                            <svg viewBox="0 0 48 48" width="40" height="40"><rect x="8" y="10" width="32" height="28" fill="none" stroke="currentColor" stroke-width="1.8" rx="2"/><path d="M8 18h32M14 24h10M28 24h6M14 30h20M14 36h8" stroke="currentColor" stroke-width="1.4" fill="none"/></svg>
                        <?php else: ?>
                            <svg viewBox="0 0 48 48" width="40" height="40"><path d="M4 40h40M8 40V24l16-12 16 12v16M18 40V28h12v12" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                        <?php endif; ?>
                    </div>
                    <h3><?= htmlspecialchars($s['title']) ?></h3>
                    <p class="ch-stage-subtitle"><?= htmlspecialchars($s['subtitle']) ?></p>
                    <p class="ch-stage-body"><?= htmlspecialchars($s['body']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="ch-three-callout">
            <p><?= htmlspecialchars($c['three_times']['callout']) ?></p>
        </div>

        <div class="ch-three-conclusion">
            <svg viewBox="0 0 24 24" width="28" height="28" aria-hidden="true"><path d="M4 12l6 6L20 6" fill="none" stroke="#12A757" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <strong><?= htmlspecialchars($c['three_times']['conclusion']) ?></strong>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     6. CE ANALIZĂM (anvelopa)
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-envelope" id="ce-analizam">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Ce analizăm împreună</span>
            <h2><?= htmlspecialchars($c['envelope']['headline']) ?></h2>
            <p class="ch-lead"><?= htmlspecialchars($c['envelope']['lead']) ?></p>
        </div>

        <div class="ch-envelope-grid">
            <?php foreach ($c['envelope']['items'] as $i => $item): ?>
                <details class="ch-env-item" <?= $i === 0 ? 'open' : '' ?>>
                    <summary>
                        <span class="ch-env-num"><?= sprintf('%02d', $i + 1) ?></span>
                        <span class="ch-env-title"><?= htmlspecialchars($item['title']) ?></span>
                        <svg class="ch-env-chevron" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </summary>
                    <p><?= htmlspecialchars($item['desc']) ?></p>
                </details>
            <?php endforeach; ?>
        </div>

        <p class="ch-envelope-note"><?= htmlspecialchars($c['envelope']['note']) ?></p>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     7. CE PRIMEȘTI CONCRET
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-deliverables" id="livrabile">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Livrabile concrete</span>
            <h2><?= htmlspecialchars($c['deliverables']['headline']) ?></h2>
        </div>

        <div class="ch-deliv-grid">
            <?php foreach ($c['deliverables']['items'] as $d): ?>
                <div class="ch-deliv-card">
                    <div class="ch-deliv-icon" aria-hidden="true">
                        <?php
                        // Simple SVG per icon key
                        $svgs = [
                            'chart'     => '<path d="M4 20V6h16v14zM8 16v-4M12 16V9M16 16v-6" stroke="currentColor" stroke-width="1.8" fill="none" stroke-linecap="round"/>',
                            'model'     => '<circle cx="12" cy="12" r="8" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 4v16M4 12h16M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="1" fill="none"/>',
                            'scenarios' => '<rect x="3" y="4" width="6" height="16" fill="none" stroke="currentColor" stroke-width="1.8" rx="1"/><rect x="10" y="8" width="6" height="12" fill="none" stroke="currentColor" stroke-width="1.8" rx="1"/><rect x="17" y="12" width="4" height="8" fill="none" stroke="currentColor" stroke-width="1.8" rx="1"/>',
                            'roadmap'   => '<circle cx="6" cy="18" r="3" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="18" cy="6" r="3" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M9 18h4a3 3 0 003-3v0a3 3 0 013-3h1M8 6h4a3 3 0 013 3v0a3 3 0 003 3h1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>',
                            'details'   => '<circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M8 12l3 3 5-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
                            'report'    => '<path d="M7 3h8l4 4v14H7z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M15 3v4h4M10 12h6M10 16h6M10 8h3" stroke="currentColor" stroke-width="1.8" fill="none" stroke-linecap="round"/>',
                            'meetings'  => '<circle cx="8" cy="10" r="3" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="16" cy="10" r="3" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M3 20c0-3 2-5 5-5s5 2 5 5M11 20c0-3 2-5 5-5s5 2 5 5" fill="none" stroke="currentColor" stroke-width="1.8"/>',
                            'site'      => '<path d="M4 21h16M6 21V11l6-4 6 4v10M10 21v-6h4v6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>',
                        ];
                        echo '<svg viewBox="0 0 24 24" width="32" height="32">' . ($svgs[$d['icon']] ?? '') . '</svg>';
                        ?>
                    </div>
                    <h3><?= htmlspecialchars($d['title']) ?></h3>
                    <p><?= htmlspecialchars($d['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     8. PROCESUL
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-process" id="proces">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Cum lucrăm împreună</span>
            <h2><?= htmlspecialchars($c['process']['headline']) ?></h2>
        </div>

        <div class="ch-process-steps">
            <?php foreach ($c['process']['steps'] as $i => $step): ?>
                <div class="ch-proc-step">
                    <div class="ch-proc-line" aria-hidden="true"></div>
                    <div class="ch-proc-num"><?= htmlspecialchars($step['n']) ?></div>
                    <h3><?= htmlspecialchars($step['title']) ?></h3>
                    <p><?= htmlspecialchars($step['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     9. PACHETE
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-packages" id="pachete">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Pachetele de consultanță</span>
            <h2>Alege pachetul potrivit stadiului tău</h2>
            <p class="ch-lead">Toate pachetele au un scop comun: să eviți deciziile greșite înainte să devină scumpe. Alegi în funcție de stadiul proiectului și de nivelul de sprijin dorit.</p>
        </div>

        <div class="ch-packages-grid">
            <?php foreach ($c['packages'] as $i => $pkg): ?>
                <div class="ch-package <?= !empty($pkg['highlight']) ? 'ch-package-highlight' : '' ?>"
                     id="pkg-<?= htmlspecialchars($pkg['id']) ?>">
                    <?php if (!empty($pkg['highlight'])): ?>
                        <div class="ch-package-flag">Recomandat înainte de execuție</div>
                    <?php endif; ?>
                    <div class="ch-package-num"><?= $i + 1 ?></div>
                    <h3 class="ch-package-name"><?= htmlspecialchars($pkg['name']) ?></h3>
                    <p class="ch-package-tagline"><?= htmlspecialchars($pkg['tagline']) ?></p>
                    <p class="ch-package-ideal-for"><em><?= htmlspecialchars($pkg['ideal_for']) ?></em></p>

                    <ul class="ch-package-features">
                        <?php foreach ($pkg['features'] as $f): ?>
                            <li>
                                <svg class="ch-icon-check" viewBox="0 0 20 20" aria-hidden="true"><path d="M4 10.5l4 4 8-9" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <?= htmlspecialchars($f) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if (!empty($pkg['note'])): ?>
                        <p class="ch-package-note"><?= htmlspecialchars($pkg['note']) ?></p>
                    <?php endif; ?>

                    <div class="ch-package-price"><?= htmlspecialchars($pkg['price_note']) ?></div>
                    <a href="#formular"
                       class="ch-btn ch-btn-primary ch-btn-block ch-package-cta"
                       data-analytics="package_cta_click"
                       data-package="<?= htmlspecialchars($pkg['id']) ?>">
                        <?= htmlspecialchars($pkg['cta_label']) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Statistica PHI -->
        <div class="ch-stat">
            <div class="ch-stat-icon" aria-hidden="true">
                <svg viewBox="0 0 40 40" width="36" height="36"><path d="M20 4l4 12h12l-10 8 4 12-10-8-10 8 4-12L4 16h12z" fill="#F4A100"/></svg>
            </div>
            <div class="ch-stat-txt">
                <p><?= htmlspecialchars($c['stat']['text']) ?></p>
                <p class="ch-stat-source">Sursa: <?= htmlspecialchars($c['stat']['source']) ?>. <span class="ch-stat-disclaimer"><?= htmlspecialchars($c['stat']['disclaimer']) ?></span></p>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     10. DESPRE MIRCEA
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-about" id="despre">
    <div class="container">
        <div class="ch-about-grid">
            <div class="ch-about-visual">
                <div class="ch-about-frame">
                    <img src="<?= htmlspecialchars($c['about']['image']) ?>"
                         alt="<?= htmlspecialchars($c['about']['image_alt']) ?>"
                         class="ch-about-img"
                         loading="lazy"
                         width="480" height="600"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="ch-about-fallback" style="display:none;" aria-hidden="true">
                        <svg viewBox="0 0 200 250" width="180" height="220"><rect width="200" height="250" fill="#F0F4F8" rx="12"/><circle cx="100" cy="90" r="35" fill="#D0D5DD"/><path d="M40 220 Q40 160 100 160 Q160 160 160 220 Z" fill="#D0D5DD"/><text x="100" y="245" text-anchor="middle" font-size="10" fill="#7A7A7A" font-family="sans-serif">Foto Mircea în șantier</text></svg>
                    </div>
                </div>
            </div>
            <div class="ch-about-text">
                <span class="ch-eyebrow">Despre mine</span>
                <h2><?= htmlspecialchars($c['about']['headline']) ?></h2>
                <p class="ch-lead"><?= htmlspecialchars($c['about']['lead']) ?></p>
                <?php foreach ($c['about']['body'] as $p): ?>
                    <p><?= $p // safe: constant HTML with strong tags ?></p>
                <?php endforeach; ?>

                <blockquote class="ch-quote">
                    <svg class="ch-quote-mark" viewBox="0 0 40 40" width="40" height="40" aria-hidden="true"><path d="M12 8c-4 0-8 3-8 9 0 5 4 8 8 8 2 0 4-1 4-3v-3c0-1-1-2-2-2h-2c0-3 3-4 6-4V8h-6zm18 0c-4 0-8 3-8 9 0 5 4 8 8 8 2 0 4-1 4-3v-3c0-1-1-2-2-2h-2c0-3 3-4 6-4V8h-6z" fill="#12A757"/></svg>
                    <p>„<?= htmlspecialchars($c['about']['quote']['text']) ?>"</p>
                    <cite>— <?= htmlspecialchars($c['about']['quote']['author']) ?></cite>
                </blockquote>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     11. STUDII DE CAZ (visible: false)
     ═════════════════════════════════════════════════════════════════ -->
<?php if (!empty($c['case_studies']['visible']) && !empty($c['case_studies']['items'])): ?>
<section class="ch-cases" id="studii-caz">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Studii de caz</span>
            <h2><?= htmlspecialchars($c['case_studies']['headline']) ?></h2>
            <p class="ch-lead"><?= htmlspecialchars($c['case_studies']['lead']) ?></p>
        </div>
        <!-- Renderer here when items are populated -->
    </div>
</section>
<?php endif; ?>

<!-- ═════════════════════════════════════════════════════════════════
     12. TESTIMONIALE (visible: false)
     ═════════════════════════════════════════════════════════════════ -->
<?php if (!empty($c['testimonials']['visible']) && !empty($c['testimonials']['items'])): ?>
<section class="ch-testimonials" id="testimoniale">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Testimoniale</span>
            <h2><?= htmlspecialchars($c['testimonials']['headline']) ?></h2>
        </div>
        <!-- Renderer here when items are populated -->
    </div>
</section>
<?php endif; ?>

<!-- ═════════════════════════════════════════════════════════════════
     13. FAQ
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-faq" id="faq">
    <div class="container">
        <div class="ch-section-head ch-center">
            <span class="ch-eyebrow">Întrebări frecvente</span>
            <h2><?= htmlspecialchars($c['faq']['headline']) ?></h2>
        </div>

        <div class="ch-faq-list">
            <?php foreach ($c['faq']['items'] as $i => $q): ?>
                <details class="ch-faq-item">
                    <summary>
                        <span class="ch-faq-q"><?= htmlspecialchars($q['q']) ?></span>
                        <svg class="ch-faq-chevron" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </summary>
                    <div class="ch-faq-a">
                        <p><?= $q['a'] // safe: constant HTML with strong tags ?></p>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     14. FORMULAR MULTI-STEP
     ═════════════════════════════════════════════════════════════════ -->
<section class="ch-form-section" id="formular">
    <div class="container">
        <div class="ch-form-head">
            <span class="ch-eyebrow">Aplică pentru consultanță</span>
            <h2><?= htmlspecialchars($c['cta_final']['headline']) ?></h2>
            <p class="ch-lead"><?= htmlspecialchars($c['cta_final']['body']) ?></p>
        </div>

        <?php if ($hasErrors): ?>
            <div class="ch-form-errors" role="alert">
                <strong>Formularul nu a putut fi trimis. Corectează erorile de mai jos și încearcă din nou.</strong>
            </div>
        <?php endif; ?>

        <form method="POST"
              action="/consultanta-passive-house/aplica"
              class="ch-form"
              enctype="multipart/form-data"
              novalidate
              id="consultingForm"
              aria-labelledby="formularHeader">

            <!-- Honeypot fields (hidden) -->
            <div class="ch-honeypot" aria-hidden="true">
                <label>Nu completa acest câmp <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                <label>Nu completa acest câmp <input type="text" name="company_extra" tabindex="-1" autocomplete="off"></label>
            </div>

            <!-- Progress indicator -->
            <ol class="ch-form-steps-nav" aria-label="Pași formular">
                <li data-step="1" class="active"><span>1</span> Proiect</li>
                <li data-step="2"><span>2</span> Stadiu</li>
                <li data-step="3"><span>3</span> Obiectiv</li>
                <li data-step="4"><span>4</span> Pachet</li>
                <li data-step="5"><span>5</span> Documente</li>
                <li data-step="6"><span>6</span> Contact</li>
            </ol>

            <!-- STEP 1: PROJECT -->
            <fieldset class="ch-form-step active" data-step="1">
                <legend>Pasul 1 din 6 — Despre proiect</legend>

                <div class="ch-form-row">
                    <div class="ch-form-group">
                        <label for="f-project-type">Tip de proiect <span class="ch-required">*</span></label>
                        <select id="f-project-type" name="project_type" required>
                            <option value="">Alege...</option>
                            <?php foreach ($c['form']['step1_project_types'] as $k => $v): ?>
                                <option value="<?= htmlspecialchars($k) ?>" <?= ($fd['project_type'] ?? '') === $k ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($v) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($fe['project_type'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['project_type']) ?></span><?php endif; ?>
                    </div>

                    <div class="ch-form-group">
                        <label for="f-building-type">Tip de clădire <span class="ch-required">*</span></label>
                        <select id="f-building-type" name="building_type" required>
                            <option value="">Alege...</option>
                            <?php foreach ($c['form']['step1_building_types'] as $k => $v): ?>
                                <option value="<?= htmlspecialchars($k) ?>" <?= ($fd['building_type'] ?? '') === $k ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($v) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($fe['building_type'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['building_type']) ?></span><?php endif; ?>
                    </div>
                </div>

                <div class="ch-form-row">
                    <div class="ch-form-group">
                        <label for="f-city">Localitate <span class="ch-required">*</span></label>
                        <input type="text" id="f-city" name="location_city" required
                               placeholder="ex. București, Ploiești, Iași"
                               value="<?= htmlspecialchars($fd['location_city'] ?? '') ?>">
                        <?php if (!empty($fe['location_city'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['location_city']) ?></span><?php endif; ?>
                    </div>

                    <div class="ch-form-group">
                        <label for="f-county">Județ <span class="ch-optional">(opțional)</span></label>
                        <input type="text" id="f-county" name="location_county"
                               placeholder="ex. Ilfov, Prahova"
                               value="<?= htmlspecialchars($fd['location_county'] ?? '') ?>">
                    </div>
                </div>

                <div class="ch-form-row">
                    <div class="ch-form-group">
                        <label for="f-area">Suprafață utilă estimată (m²) <span class="ch-optional">(opțional)</span></label>
                        <input type="text" id="f-area" name="area_sqm"
                               placeholder="ex. 180"
                               value="<?= htmlspecialchars($fd['area_sqm'] ?? '') ?>">
                    </div>
                    <div class="ch-form-group">
                        <label for="f-structure">Tip structură <span class="ch-optional">(opțional)</span></label>
                        <input type="text" id="f-structure" name="structure_type"
                               placeholder="ex. cadre BCA, lemn, cadre + zidărie"
                               value="<?= htmlspecialchars($fd['structure_type'] ?? '') ?>">
                    </div>
                </div>

                <div class="ch-form-nav">
                    <button type="button" class="ch-btn ch-btn-primary" data-next="2">Continuă →</button>
                </div>
            </fieldset>

            <!-- STEP 2: STAGE -->
            <fieldset class="ch-form-step" data-step="2">
                <legend>Pasul 2 din 6 — Stadiul proiectului</legend>
                <p class="ch-form-help">În ce stadiu te afli acum?</p>

                <div class="ch-radio-grid">
                    <?php foreach ($c['form']['step2_stages'] as $k => $v): ?>
                        <label class="ch-radio-card">
                            <input type="radio" name="stage" value="<?= htmlspecialchars($k) ?>"
                                   <?= ($fd['stage'] ?? '') === $k ? 'checked' : '' ?>>
                            <span class="ch-radio-mark"></span>
                            <span class="ch-radio-label"><?= htmlspecialchars($v) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($fe['stage'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['stage']) ?></span><?php endif; ?>

                <div class="ch-form-nav">
                    <button type="button" class="ch-btn ch-btn-ghost" data-prev="1">← Înapoi</button>
                    <button type="button" class="ch-btn ch-btn-primary" data-next="3">Continuă →</button>
                </div>
            </fieldset>

            <!-- STEP 3: OBJECTIVE -->
            <fieldset class="ch-form-step" data-step="3">
                <legend>Pasul 3 din 6 — Obiectivul tău</legend>
                <p class="ch-form-help">Poți alege mai multe opțiuni.</p>

                <div class="ch-check-grid">
                    <?php $selectedObj = $fd['objectives'] ?? []; ?>
                    <?php foreach ($c['form']['step3_objectives'] as $k => $v): ?>
                        <label class="ch-check-card">
                            <input type="checkbox" name="objectives[]" value="<?= htmlspecialchars($k) ?>"
                                   <?= in_array($k, $selectedObj, true) ? 'checked' : '' ?>>
                            <span class="ch-check-mark"></span>
                            <span class="ch-check-label"><?= htmlspecialchars($v) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($fe['objectives'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['objectives']) ?></span><?php endif; ?>

                <div class="ch-form-nav">
                    <button type="button" class="ch-btn ch-btn-ghost" data-prev="2">← Înapoi</button>
                    <button type="button" class="ch-btn ch-btn-primary" data-next="4">Continuă →</button>
                </div>
            </fieldset>

            <!-- STEP 4: PACKAGE -->
            <fieldset class="ch-form-step" data-step="4">
                <legend>Pasul 4 din 6 — Pachetul dorit</legend>
                <p class="ch-form-help">Dacă nu ești sigur, alege "Nu știu încă" — îți recomand pachetul potrivit după evaluare.</p>

                <div class="ch-radio-grid">
                    <?php
                    $selectedPkg = $fd['package'] ?? $preselected ?? '';
                    foreach ($c['form']['step4_packages'] as $k => $v):
                    ?>
                        <label class="ch-radio-card">
                            <input type="radio" name="package" value="<?= htmlspecialchars($k) ?>"
                                   <?= $selectedPkg === $k ? 'checked' : '' ?>>
                            <span class="ch-radio-mark"></span>
                            <span class="ch-radio-label"><?= htmlspecialchars($v) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
                <?php if (!empty($fe['package'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['package']) ?></span><?php endif; ?>

                <div class="ch-form-nav">
                    <button type="button" class="ch-btn ch-btn-ghost" data-prev="3">← Înapoi</button>
                    <button type="button" class="ch-btn ch-btn-primary" data-next="5">Continuă →</button>
                </div>
            </fieldset>

            <!-- STEP 5: DOCUMENTS -->
            <fieldset class="ch-form-step" data-step="5">
                <legend>Pasul 5 din 6 — Documente <span class="ch-optional">(opțional)</span></legend>
                <p class="ch-form-help">
                    Poți încărca planuri, secțiuni, fațade, memoriu de arhitectură sau alte documente relevante.
                    Acceptate: <?= implode(', ', $c['form']['upload_allowed']) ?> — maximum <?= $c['form']['upload_max_files'] ?> fișiere, <?= $c['form']['upload_max_size_mb'] ?> MB fiecare.
                </p>

                <div class="ch-upload-wrap">
                    <label for="f-docs" class="ch-upload-label">
                        <svg viewBox="0 0 40 40" width="32" height="32" aria-hidden="true"><path d="M20 26V8m0 0l-7 7m7-7l7 7M6 30v3a2 2 0 002 2h24a2 2 0 002-2v-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>Trage fișierele aici sau <strong>alege de pe calculator</strong></span>
                        <small>Poți sări peste acest pas dacă nu ai încă documente</small>
                    </label>
                    <input type="file" id="f-docs" name="documents[]" multiple
                           accept="<?= '.' . implode(',.', $c['form']['upload_allowed']) ?>">
                    <ul class="ch-upload-list" id="uploadList"></ul>
                    <?php if (!empty($fe['documents'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['documents']) ?></span><?php endif; ?>
                </div>

                <div class="ch-form-nav">
                    <button type="button" class="ch-btn ch-btn-ghost" data-prev="4">← Înapoi</button>
                    <button type="button" class="ch-btn ch-btn-primary" data-next="6">Continuă →</button>
                </div>
            </fieldset>

            <!-- STEP 6: CONTACT -->
            <fieldset class="ch-form-step" data-step="6">
                <legend>Pasul 6 din 6 — Datele tale de contact</legend>

                <div class="ch-form-row">
                    <div class="ch-form-group">
                        <label for="f-name">Nume complet <span class="ch-required">*</span></label>
                        <input type="text" id="f-name" name="name" required
                               autocomplete="name"
                               placeholder="ex. Ion Popescu"
                               value="<?= htmlspecialchars($fd['name'] ?? '') ?>">
                        <?php if (!empty($fe['name'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['name']) ?></span><?php endif; ?>
                    </div>

                    <div class="ch-form-group">
                        <label for="f-phone">Telefon <span class="ch-required">*</span></label>
                        <input type="tel" id="f-phone" name="phone" required
                               autocomplete="tel"
                               placeholder="ex. 0722 123 456"
                               value="<?= htmlspecialchars($fd['phone'] ?? '') ?>">
                        <?php if (!empty($fe['phone'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['phone']) ?></span><?php endif; ?>
                    </div>
                </div>

                <div class="ch-form-group">
                    <label for="f-email">Email <span class="ch-required">*</span></label>
                    <input type="email" id="f-email" name="email" required
                           autocomplete="email"
                           placeholder="ex. ion.popescu@email.com"
                           value="<?= htmlspecialchars($fd['email'] ?? '') ?>">
                    <?php if (!empty($fe['email'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['email']) ?></span><?php endif; ?>
                </div>

                <div class="ch-form-row">
                    <div class="ch-form-group">
                        <label for="f-contact-pref">Preferi să te contactez prin <span class="ch-required">*</span></label>
                        <select id="f-contact-pref" name="contact_pref" required>
                            <option value="">Alege...</option>
                            <?php foreach ($c['form']['step6_contact_preferences'] as $k => $v): ?>
                                <option value="<?= htmlspecialchars($k) ?>" <?= ($fd['contact_pref'] ?? '') === $k ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($v) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($fe['contact_pref'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['contact_pref']) ?></span><?php endif; ?>
                    </div>

                    <div class="ch-form-group">
                        <label for="f-contact-time">Interval orientativ <span class="ch-optional">(opțional)</span></label>
                        <select id="f-contact-time" name="contact_time">
                            <option value="">Alege...</option>
                            <?php foreach ($c['form']['step6_contact_times'] as $k => $v): ?>
                                <option value="<?= htmlspecialchars($k) ?>" <?= ($fd['contact_time'] ?? '') === $k ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($v) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="ch-form-group">
                    <label for="f-message">Mesaj suplimentar <span class="ch-optional">(opțional)</span></label>
                    <textarea id="f-message" name="message" rows="4"
                              placeholder="Ce e important să știu despre proiectul tău?"><?= htmlspecialchars($fd['message'] ?? '') ?></textarea>
                </div>

                <div class="ch-form-consent">
                    <label class="ch-check-inline">
                        <input type="checkbox" name="consent_gdpr" required <?= !empty($fd['consent_gdpr']) ? 'checked' : '' ?>>
                        <span>Sunt de acord cu <a href="/politica-confidentialitate" target="_blank" rel="noopener">prelucrarea datelor personale</a> pentru procesarea aplicației. <span class="ch-required">*</span></span>
                    </label>
                    <?php if (!empty($fe['consent_gdpr'])): ?><span class="ch-field-error"><?= htmlspecialchars($fe['consent_gdpr']) ?></span><?php endif; ?>

                    <label class="ch-check-inline">
                        <input type="checkbox" name="consent_marketing" <?= !empty($fd['consent_marketing']) ? 'checked' : '' ?>>
                        <span>Sunt de acord să primesc actualizări ocazionale despre eficiență energetică și construcții sănătoase. <span class="ch-optional">(opțional)</span></span>
                    </label>
                </div>

                <div class="ch-form-nav">
                    <button type="button" class="ch-btn ch-btn-ghost" data-prev="5">← Înapoi</button>
                    <button type="submit" class="ch-btn ch-btn-primary ch-btn-lg" data-analytics="form_submit_success">
                        Trimite aplicația
                        <svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </fieldset>

        </form>

        <div class="ch-form-side">
            <p><strong>Preferi să vorbești direct?</strong></p>
            <div class="ch-quick-contact">
                <a href="tel:<?= htmlspecialchars($c['expert']['contact']['phone']) ?>"
                   class="ch-quick-link"
                   data-analytics="phone_click">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3.1 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3.1-8.7A2 2 0 014.1 2h3a2 2 0 012 1.7c.1 1 .3 2 .6 2.9a2 2 0 01-.5 2.1L8 10a16 16 0 006 6l1.3-1.3a2 2 0 012.1-.4c.9.3 1.9.5 2.9.6a2 2 0 011.7 2z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                    <?= htmlspecialchars($c['expert']['contact']['phone']) ?>
                </a>
                <a href="mailto:<?= htmlspecialchars($c['expert']['contact']['email']) ?>"
                   class="ch-quick-link"
                   data-analytics="email_click">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M4 4h16v16H4z" fill="none" stroke="currentColor" stroke-width="2"/><path d="M4 4l8 8 8-8" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                    <?= htmlspecialchars($c['expert']['contact']['email']) ?>
                </a>
                <a href="https://wa.me/<?= preg_replace('/\D/', '', $c['expert']['contact']['whatsapp']) ?>"
                   class="ch-quick-link ch-quick-whatsapp"
                   target="_blank" rel="noopener"
                   data-analytics="whatsapp_click">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 2C6.5 2 2 6.5 2 12c0 1.8.5 3.4 1.3 4.9L2 22l5.3-1.4c1.5.8 3 1.2 4.7 1.2 5.5 0 10-4.5 10-10S17.5 2 12 2z" fill="#25D366"/><path d="M17 14.5c-.2-.1-1.3-.6-1.5-.7-.2-.1-.4-.1-.5.1-.2.2-.6.7-.7.8-.1.1-.2.2-.5.1-.2-.1-1-.4-1.8-1.1-.7-.6-1.1-1.4-1.3-1.6-.1-.2 0-.3.1-.5l.4-.4c.1-.1.1-.2.2-.4 0-.1 0-.3 0-.4-.1-.1-.5-1.3-.7-1.7-.2-.4-.4-.4-.5-.4h-.4c-.2 0-.4.1-.6.3-.2.2-.8.8-.8 2s.9 2.3 1 2.5c.1.2 1.8 2.8 4.4 3.9.6.3 1.1.4 1.5.5.6.2 1.2.2 1.6.1.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.1-1.2-.1-.1-.2-.2-.4-.3z" fill="#fff"/></svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ═════════════════════════════════════════════════════════════════
     15. MOBILE STICKY CTA
     ═════════════════════════════════════════════════════════════════ -->
<div class="ch-mobile-cta" id="mobileCta">
    <a href="#formular" class="ch-btn ch-btn-primary ch-btn-block" data-analytics="mobile_sticky_cta_click">
        Aplică pentru consultanță
    </a>
</div>

<!-- ═════════════════════════════════════════════════════════════════
     Behavior JS — pași form + UI + analytics event dispatching
     ═════════════════════════════════════════════════════════════════ -->
<script>
(function(){
    'use strict';

    // ═══ Multi-step form ═══
    var form = document.getElementById('consultingForm');
    if (form) {
        var steps = form.querySelectorAll('.ch-form-step');
        var nav = form.querySelector('.ch-form-steps-nav');
        var navItems = nav ? nav.querySelectorAll('li') : [];

        function goToStep(target) {
            var targetInt = parseInt(target, 10);
            steps.forEach(function(s){
                var stepNum = parseInt(s.getAttribute('data-step'), 10);
                s.classList.toggle('active', stepNum === targetInt);
            });
            navItems.forEach(function(li){
                var liNum = parseInt(li.getAttribute('data-step'), 10);
                li.classList.toggle('active', liNum === targetInt);
                li.classList.toggle('done', liNum < targetInt);
            });
            // Scroll to top of form
            var formTop = form.getBoundingClientRect().top + window.scrollY - 100;
            window.scrollTo({top: formTop, behavior: 'smooth'});
            // Analytics event
            dispatchEvent('form_step_complete', {step: targetInt});
        }

        // Validate current step before advancing
        function validateStep(stepNum) {
            var step = form.querySelector('.ch-form-step[data-step="' + stepNum + '"]');
            if (!step) return true;
            var errors = [];

            // Clear previous inline errors on this step
            step.querySelectorAll('.ch-field-error-js').forEach(function(el){ el.remove(); });
            step.querySelectorAll('.ch-has-error').forEach(function(el){ el.classList.remove('ch-has-error'); });

            // Required inputs
            step.querySelectorAll('[required]').forEach(function(el){
                if (el.type === 'radio') {
                    var name = el.name;
                    var group = form.querySelectorAll('input[name="' + name + '"]');
                    var checked = Array.from(group).some(function(r){ return r.checked; });
                    if (!checked && errors.indexOf(name) === -1) {
                        markError(el.closest('.ch-radio-grid') || el, 'Alege o opțiune.');
                        errors.push(name);
                    }
                } else if (el.type === 'checkbox') {
                    if (!el.checked) {
                        markError(el.closest('.ch-check-inline, .ch-form-group') || el, 'Este obligatoriu.');
                        errors.push(el.name);
                    }
                } else if (!el.value.trim()) {
                    markError(el, 'Este obligatoriu.');
                    errors.push(el.name);
                } else if (el.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value)) {
                    markError(el, 'Adresa de email nu e validă.');
                    errors.push(el.name);
                } else if (el.type === 'tel' && el.value.replace(/\D/g, '').length < 9) {
                    markError(el, 'Numărul de telefon nu e valid.');
                    errors.push(el.name);
                }
            });

            // Step 3 — at least one objective must be checked
            if (stepNum === 3) {
                var checkedObj = step.querySelectorAll('input[name="objectives[]"]:checked');
                if (checkedObj.length === 0) {
                    markError(step.querySelector('.ch-check-grid'), 'Alege cel puțin un obiectiv.');
                    errors.push('objectives');
                }
            }

            return errors.length === 0;
        }

        function markError(el, msg) {
            var container = el.classList && el.classList.contains('ch-form-group') ? el : (el.closest ? el.closest('.ch-form-group') : null) || el;
            container.classList.add('ch-has-error');
            var span = document.createElement('span');
            span.className = 'ch-field-error ch-field-error-js';
            span.textContent = msg;
            container.appendChild(span);
        }

        form.addEventListener('click', function(e){
            var next = e.target.closest('[data-next]');
            var prev = e.target.closest('[data-prev]');
            if (next) {
                e.preventDefault();
                var currentStep = e.target.closest('.ch-form-step');
                var currentStepNum = parseInt(currentStep.getAttribute('data-step'), 10);
                if (validateStep(currentStepNum)) {
                    goToStep(next.getAttribute('data-next'));
                }
            }
            if (prev) {
                e.preventDefault();
                goToStep(prev.getAttribute('data-prev'));
            }
        });

        // Allow nav items to jump to previous completed steps
        navItems.forEach(function(li){
            li.addEventListener('click', function(){
                if (li.classList.contains('done')) {
                    goToStep(li.getAttribute('data-step'));
                }
            });
        });

        // Track form start
        var formStarted = false;
        form.addEventListener('focusin', function(){
            if (!formStarted) {
                formStarted = true;
                dispatchEvent('form_start');
            }
        }, {once: true});

        // Upload list preview
        var docInput = document.getElementById('f-docs');
        var uploadList = document.getElementById('uploadList');
        if (docInput && uploadList) {
            docInput.addEventListener('change', function(){
                uploadList.innerHTML = '';
                Array.from(docInput.files).forEach(function(f){
                    var li = document.createElement('li');
                    li.textContent = f.name + ' (' + Math.round(f.size / 1024) + ' KB)';
                    uploadList.appendChild(li);
                });
                dispatchEvent('form_upload', {files: docInput.files.length});
            });
        }

        // Full final validation on submit
        form.addEventListener('submit', function(e){
            var ok = validateStep(6);
            if (!ok) {
                e.preventDefault();
                dispatchEvent('form_submit_error');
            }
        });
    }

    // ═══ Package CTA → preselect package in form ═══
    document.querySelectorAll('.ch-package-cta').forEach(function(a){
        a.addEventListener('click', function(){
            var pkg = a.getAttribute('data-package');
            if (pkg) {
                var radio = document.querySelector('.ch-form-step[data-step="4"] input[value="' + pkg + '"]');
                if (radio) radio.checked = true;
                dispatchEvent('package_cta_click', {package: pkg});
            }
        });
    });

    // ═══ Mobile sticky CTA — show after scroll ═══
    var mobileCta = document.getElementById('mobileCta');
    if (mobileCta) {
        var lastScroll = 0;
        window.addEventListener('scroll', function(){
            var pageHeight = document.documentElement.scrollHeight - window.innerHeight;
            var scrolled = window.scrollY;
            var pct = scrolled / pageHeight;
            // Show after 20% scroll, hide when in-form
            var formSect = document.getElementById('formular');
            var formVisible = formSect && formSect.getBoundingClientRect().top < window.innerHeight * 0.9;
            mobileCta.classList.toggle('visible', pct > 0.2 && !formVisible);
            lastScroll = scrolled;
        }, {passive: true});
    }

    // ═══ Analytics dispatch (GA4 stub, ready to activate) ═══
    function dispatchEvent(name, params) {
        params = params || {};
        // Console debug
        if (window.console && console.debug) {
            console.debug('[consulting analytics]', name, params);
        }
        // GA4 gtag (activated when Measurement ID is configured)
        if (typeof window.gtag === 'function') {
            window.gtag('event', 'consulting_' + name, params);
        }
        // Fallback: dataLayer push (works with GTM)
        if (window.dataLayer && Array.isArray(window.dataLayer)) {
            window.dataLayer.push(Object.assign({event: 'consulting_' + name}, params));
        }
    }

    // Auto-tag [data-analytics] clicks
    document.querySelectorAll('[data-analytics]').forEach(function(el){
        el.addEventListener('click', function(){
            dispatchEvent(el.getAttribute('data-analytics'), {
                package: el.getAttribute('data-package') || undefined,
                cert:    el.getAttribute('data-cert') || undefined,
            });
        });
    });

    // FAQ open event
    document.querySelectorAll('.ch-faq-item').forEach(function(d){
        d.addEventListener('toggle', function(){
            if (d.open) {
                dispatchEvent('faq_open', {q: d.querySelector('.ch-faq-q').textContent.trim()});
            }
        });
    });

    // Package visible event (IntersectionObserver)
    if ('IntersectionObserver' in window) {
        var pkgSection = document.getElementById('pachete');
        if (pkgSection) {
            var io = new IntersectionObserver(function(entries){
                entries.forEach(function(e){
                    if (e.isIntersecting) {
                        dispatchEvent('section_pachete_view');
                        io.disconnect();
                    }
                });
            }, {threshold: 0.3});
            io.observe(pkgSection);
        }
    }

})();
</script>

<?php if ($hasErrors): ?>
<script>
// If we came back with server-side errors, jump to form
document.addEventListener('DOMContentLoaded', function(){
    var form = document.getElementById('formular');
    if (form) form.scrollIntoView({behavior: 'smooth', block: 'start'});
});
</script>
<?php endif; ?>
