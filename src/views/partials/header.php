<?php
$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$currentUri = rtrim($currentUri, '/') ?: '/';
?>

<!-- TOP BAR -->
<div class="top-bar" id="topBar">
    <div class="container">
        <div class="top-bar-left">
            <a href="tel:+40756034734">&#128222; 0756.034.734</a>
            <span class="top-bar-separator">|</span>
            <a href="mailto:office@bdmacoperis.ro">&#9993; office@bdmacoperis.ro</a>
        </div>
        <div class="top-bar-right">
            <span class="delivery-text">&#128666; Livram in toata tara</span>
            <span class="top-bar-separator">|</span>
            <a href="https://www.facebook.com/bdmsystems" target="_blank" rel="noopener">f Facebook</a>
        </div>
    </div>
</div>

<!-- HEADER PRINCIPAL -->
<header class="site-header" id="siteHeader">
    <div class="container">
        <div class="header-main">

            <a href="/" class="site-logo">
                <img src="/images/logo/logo-full.png" alt="BDM Systems - acoperisuri.info" width="200" height="55" fetchpriority="high">
            </a>

            <!-- Desktop Navigation -->
            <nav class="site-nav" aria-label="Navigare principala">
                <ul class="nav-list">

                    <!-- PRODUSE - Mega Menu cu 2 coloane -->
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-link-produse" onclick="return false;">
                            &#9776; Produse <span class="arrow">&#9660;</span>
                        </a>
                        <div class="mega-produse" id="megaProduse">
                            <!-- Coloana stanga: Categorii -->
                            <div class="mega-categories">
                                <a href="/tigla-metalica" class="mega-cat-link has-sub" data-panel="panel-tigla">Tigla metalica <span class="cat-arrow">&#9654;</span></a>
                                <a href="/tabla-faltuita" class="mega-cat-link has-sub" data-panel="panel-tabla-falt">Tabla faltuita <span class="cat-arrow">&#9654;</span></a>
                                <a href="/tabla-click" class="mega-cat-link has-sub" data-panel="panel-tabla-click">Tabla click <span class="cat-arrow">&#9654;</span></a>
                                <a href="/tabla-cutata" class="mega-cat-link has-sub" data-panel="panel-tabla-cutata">Tabla cutata <span class="cat-arrow">&#9654;</span></a>
                                <a href="/sisteme-pluviale" class="mega-cat-link has-sub" data-panel="panel-pluviale">Sisteme pluviale <span class="cat-arrow">&#9654;</span></a>
                                <a href="/folii-anticondens" class="mega-cat-link has-sub" data-panel="panel-folii">Folii si membrane <span class="cat-arrow">&#9654;</span></a>
                                <a href="/accesorii-acoperis" class="mega-cat-link">Accesorii acoperis</a>
                                <a href="/sipci-metalice" class="mega-cat-link">Sipci metalice</a>
                                <a href="/sageac-metalic" class="mega-cat-link">Sageac metalic</a>
                                <a href="/tamplarie-pvc-aluminiu" class="mega-cat-link">Tamplarie PVC si Aluminiu</a>
                                <a href="/ferestre-fakro" class="mega-cat-link">Ferestre si luminatoare FAKRO</a>
                                <a href="/scari-pod-fakro" class="mega-cat-link">Scari de pod FAKRO</a>
                                <a href="/izolatie" class="mega-cat-link">Izolatie fibre lemn STEICO</a>
                                <a href="/hidroizolatii-terase" class="mega-cat-link">Hidroizolatii terase</a>
                                <a href="/garduri" class="mega-cat-link has-sub" data-panel="panel-garduri">Garduri <span class="cat-arrow">&#9654;</span></a>
                            </div>

                            <!-- Coloana dreapta: Subcategorii (apar la hover) -->
                            <div class="mega-subcategories">
                                <p class="mega-default-msg">Trece cu mouse-ul pe o categorie<br>pentru a vedea subcategoriile.</p>

                                <div class="mega-sub-panel" id="panel-tigla">
                                    <h4>Tigla metalica</h4>
                                    <div class="sub-group">
                                        <a href="/tigla-metalica/budmat" class="sub-group-title">Budmat</a>
                                        <div class="sub-items">
                                            <a href="/produs/budmat-venecja">Venecja</a>
                                            <a href="/produs/budmat-bella-sara">Bella Sara</a>
                                            <a href="/produs/budmat-como">Como</a>
                                        </div>
                                    </div>
                                    <div class="sub-group">
                                        <a href="/tigla-metalica/metigla" class="sub-group-title">Metigla</a>
                                        <div class="sub-items">
                                            <a href="/produs/metigla-elit">Elit</a>
                                            <a href="/produs/metigla-star">Star</a>
                                            <a href="/produs/metigla-mira">Mira</a>
                                        </div>
                                    </div>
                                    <div class="sub-group">
                                        <a href="/tigla-metalica/rufster" class="sub-group-title">Rufster</a>
                                        <div class="sub-items">
                                            <a href="/produs/rufster-aqua-3d">Aqua 3D</a>
                                            <a href="/produs/rufster-celesta">Celesta</a>
                                            <a href="/produs/rufster-nova">Nova</a>
                                            <a href="/produs/rufster-terra">Terra</a>
                                        </div>
                                    </div>
                                    <a href="/tigla-metalica/blachotrapez">Blachotrapez</a>
                                    <a href="/tigla-metalica/wetterbest">Wetterbest</a>
                                </div>

                                <div class="mega-sub-panel" id="panel-tabla-falt">
                                    <h4>Tabla faltuita</h4>
                                    <a href="/tabla-faltuita/metigla">Metigla</a>
                                    <a href="/tabla-faltuita/vestalpin">Voestalpine</a>
                                    <a href="/tabla-faltuita/wetterbest">Wetterbest</a>
                                </div>

                                <div class="mega-sub-panel" id="panel-tabla-click">
                                    <h4>Tabla click</h4>
                                    <a href="/tabla-click/metigla">Metigla</a>
                                    <a href="/tabla-click/wetterbest">Wetterbest</a>
                                </div>

                                <div class="mega-sub-panel" id="panel-tabla-cutata">
                                    <h4>Tabla cutata</h4>
                                    <a href="/tabla-cutata/metigla">Metigla</a>
                                    <a href="/tabla-cutata/wetterbest">Wetterbest</a>
                                    <a href="/tabla-cutata/blachotrapez">Blachotrapez</a>
                                    <a href="/tabla-cutata/rufster">Rufster</a>
                                </div>

                                <div class="mega-sub-panel" id="panel-pluviale">
                                    <h4>Sisteme pluviale</h4>
                                    <a href="/sisteme-pluviale/metigla">Sistem de scurgere Metigla</a>
                                    <a href="/sisteme-pluviale/wetterbest">Sistem de scurgere Wetterbest</a>
                                    <a href="/sisteme-pluviale/flamingo-iq-budmat">Flamingo iQ Budmat</a>
                                </div>

                                <div class="mega-sub-panel" id="panel-folii">
                                    <h4>Folii si membrane Riwega</h4>
                                    <a href="/folii-anticondens/folii-bdm">Folii BDM Systems</a>
                                    <a href="/folii-anticondens/membrane-difuzie-acoperis">Membrane difuzie acoperis</a>
                                    <a href="/folii-anticondens/membrane-control-vapori">Membrane control vapori</a>
                                    <a href="/folii-anticondens/bariere-vapori">Bariere de vapori</a>
                                    <a href="/folii-anticondens/membrane-fatada">Membrane fatada</a>
                                    <a href="/folii-anticondens/covoare-tabla-faltuita">Covoare tabla faltuita</a>
                                    <a href="/folii-anticondens/membrane-autoadezive">Membrane autoadezive</a>
                                </div>

                                <div class="mega-sub-panel" id="panel-garduri">
                                    <h4>Sisteme de garduri</h4>
                                    <a href="/garduri/rufster">Sistem Gard Rufster</a>
                                    <a href="/garduri/wetterbest">Sistem Gard Wetterbest</a>
                                    <a href="/garduri/budmat">Sistem Gard Budmat</a>
                                    <a href="/garduri/bdm">Sistem Gard BDM <span style="color: var(--color-primary); font-weight: 600;">- Cel mai bun pret</span></a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- SERVICII -->
                    <li class="nav-item">
                        <a href="/servicii" class="nav-link <?= str_starts_with($currentUri, '/servicii') ? 'active' : '' ?>">Servicii</a>
                    </li>

                    <!-- CONSULTANTA PASSIVE HOUSE -->
                    <li class="nav-item">
                        <a href="/consultanta-passive-house" class="nav-link <?= $currentUri === '/consultanta-passive-house' ? 'active' : '' ?>">Consultanta Passive House</a>
                    </li>

                    <!-- VIDEOURI -->
                    <li class="nav-item">
                        <a href="/video" class="nav-link <?= str_starts_with($currentUri, '/video') ? 'active' : '' ?>">Videouri</a>
                    </li>

                    <!-- EVENIMENTE -->
                    <li class="nav-item">
                        <a href="/evenimente" class="nav-link <?= str_starts_with($currentUri, '/evenimente') ? 'active' : '' ?>">Evenimente</a>
                    </li>

                    <!-- CARIERE -->
                    <li class="nav-item">
                        <a href="/cariere" class="nav-link <?= str_starts_with($currentUri, '/cariere') ? 'active' : '' ?>">Cariere</a>
                    </li>

                    <!-- BLOG -->
                    <li class="nav-item">
                        <a href="/blog" class="nav-link <?= str_starts_with($currentUri, '/blog') ? 'active' : '' ?>">Blog</a>
                    </li>

                    <!-- CONTACT -->
                    <li class="nav-item">
                        <a href="/contact" class="nav-link <?= $currentUri === '/contact' ? 'active' : '' ?>">Contact</a>
                    </li>
                </ul>
            </nav>

            <!-- CTA -->
            <div class="header-cta">
                <a href="/calculator" class="btn btn-accent">
                    <span>&#128202;</span>
                    <span class="btn-text">Calculator cost</span>
                </a>
                <a href="tel:+40756034734" class="btn btn-primary">
                    <span class="phone-icon">&#128222;</span>
                    <span class="btn-text">Solicita oferta</span>
                </a>
            </div>

            <!-- Hamburger -->
            <button class="hamburger" id="hamburger" aria-label="Deschide meniul">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

<!-- MOBILE NAV -->
<div class="mobile-nav-overlay" id="mobileNav">
    <button class="mobile-nav-close" id="mobileNavClose" aria-label="Inchide meniul">&times;</button>
    <ul class="mobile-nav-list">
        <li class="mobile-nav-item">
            <a href="#" class="mobile-nav-link" data-toggle="mobile-produse">Produse <span class="arrow">&#9660;</span></a>
            <div class="mobile-subnav" id="mobile-produse">
                <div class="sub-heading">Acoperisuri</div>
                <a href="/tigla-metalica">Tigla metalica</a>
                <a href="/tabla-faltuita">Tabla faltuita</a>
                <a href="/tabla-click">Tabla click</a>
                <a href="/tabla-cutata">Tabla cutata</a>
                <a href="/folii-anticondens">Folii si membrane Riwega</a>
                <a href="/accesorii-acoperis">Accesorii acoperis</a>
                <a href="/sipci-metalice">Sipci metalice</a>
                <a href="/sageac-metalic">Sageac metalic</a>
                <div class="sub-heading">Sisteme pluviale</div>
                <a href="/sisteme-pluviale/metigla">Scurgere Metigla</a>
                <a href="/sisteme-pluviale/wetterbest">Scurgere Wetterbest</a>
                <a href="/sisteme-pluviale/flamingo-iq-budmat">Flamingo iQ Budmat</a>
                <div class="sub-heading">Tamplarie si Ferestre</div>
                <a href="/tamplarie-pvc-aluminiu">Tamplarie PVC si Aluminiu</a>
                <a href="/ferestre-fakro">Ferestre FAKRO</a>
                <a href="/scari-pod-fakro">Scari de pod FAKRO</a>
                <div class="sub-heading">Izolatie</div>
                <a href="/izolatie">Izolatie fibre lemn STEICO</a>
                <a href="/hidroizolatii-terase">Hidroizolatii terase</a>
                <div class="sub-heading">Garduri</div>
                <a href="/garduri/rufster">Sistem Gard Rufster</a>
                <a href="/garduri/wetterbest">Sistem Gard Wetterbest</a>
                <a href="/garduri/budmat">Sistem Gard Budmat</a>
                <a href="/garduri/bdm">Sistem Gard BDM</a>
            </div>
        </li>
        <li class="mobile-nav-item"><a href="/servicii" class="mobile-nav-link">Servicii</a></li>
        <li class="mobile-nav-item"><a href="/consultanta-passive-house" class="mobile-nav-link">Consultanta Passive House</a></li>
        <li class="mobile-nav-item"><a href="/video" class="mobile-nav-link">Videouri</a></li>
        <li class="mobile-nav-item"><a href="/evenimente" class="mobile-nav-link">Evenimente</a></li>
        <li class="mobile-nav-item"><a href="/cariere" class="mobile-nav-link">Cariere</a></li>
        <li class="mobile-nav-item"><a href="/blog" class="mobile-nav-link">Blog</a></li>
        <li class="mobile-nav-item"><a href="/contact" class="mobile-nav-link">Contact</a></li>
    </ul>
    <div class="mobile-cta">
        <a href="/calculator" class="btn btn-accent btn-lg">&#128202; Calculator cost acoperis</a>
        <a href="tel:+40756034734" class="btn btn-primary btn-lg">&#128222; Suna acum: 0756.034.734</a>
    </div>
    <div class="mobile-contact-info">
        <p><a href="mailto:office@bdmacoperis.ro">office@bdmacoperis.ro</a></p>
    </div>
</div>
