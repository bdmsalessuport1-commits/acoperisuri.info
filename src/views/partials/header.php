<?php
/**
 * Header complet cu top bar, navigare si mega-meniu
 */
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
            <a href="https://www.facebook.com/bdmsystems" target="_blank" rel="noopener" class="social-link">
                f Facebook
            </a>
        </div>
    </div>
</div>

<!-- HEADER PRINCIPAL -->
<header class="site-header" id="siteHeader">
    <div class="container">
        <div class="header-main">

            <!-- Logo -->
            <a href="/" class="site-logo">
                <img src="/images/logo/logo-full.png" alt="BDM Systems - acoperisuri.info">
            </a>

            <!-- Desktop Navigation -->
            <nav class="site-nav" aria-label="Navigare principala">
                <ul class="nav-list">

                    <!-- ACOPERISURI - Mega Menu -->
                    <li class="nav-item">
                        <a href="/tigla-metalica" class="nav-link <?= str_starts_with($currentUri, '/tigla') || str_starts_with($currentUri, '/tabla') || str_starts_with($currentUri, '/accesorii') ? 'active' : '' ?>">
                            Acoperisuri <span class="arrow">&#9660;</span>
                        </a>
                        <div class="mega-dropdown">
                            <div class="mega-grid">
                                <div class="mega-column">
                                    <h4>Tigla metalica</h4>
                                    <a href="/tigla-metalica/budmat">Budmat</a>
                                    <div class="sub-items">
                                        <a href="/produs/budmat-venecja">Venecja</a>
                                        <a href="/produs/budmat-bella-sara">Bella Sara</a>
                                        <a href="/produs/budmat-como">Como</a>
                                    </div>
                                    <a href="/tigla-metalica/metigla">Metigla</a>
                                    <div class="sub-items">
                                        <a href="/produs/metigla-elit">Elit</a>
                                        <a href="/produs/metigla-star">Star</a>
                                        <a href="/produs/metigla-mira">Mira</a>
                                    </div>
                                    <a href="/tigla-metalica/blachotrapez">Blachotrapez</a>
                                    <a href="/tigla-metalica/wetterbest">Wetterbest</a>
                                </div>
                                <div class="mega-column">
                                    <h4>Tabla faltuita</h4>
                                    <a href="/tabla-faltuita/metigla">Metigla</a>
                                    <a href="/tabla-faltuita/vestalpin">Vestalpin</a>
                                    <a href="/tabla-faltuita/wetterbest">Wetterbest</a>
                                    <a href="/tabla-faltuita/fals-solar-metigla">Fals solar Metigla</a>

                                    <h4 style="margin-top: var(--spacing-md);">Tabla click</h4>
                                    <a href="/tabla-click/metigla">Metigla</a>
                                    <a href="/tabla-click/wetterbest">Wetterbest</a>
                                </div>
                                <div class="mega-column">
                                    <h4>Tabla cutata</h4>
                                    <a href="/tabla-cutata/metigla">Metigla</a>
                                    <a href="/tabla-cutata/wetterbest">Wetterbest</a>
                                    <a href="/tabla-cutata/blachotrapez">Blachotrapez</a>
                                </div>
                                <div class="mega-column">
                                    <h4>Accesorii</h4>
                                    <a href="/accesorii-acoperis">Accesorii acoperis</a>
                                    <a href="/folie-anticondens">Folie anticondens</a>
                                    <a href="/sipci-metalice">Sipci metalice</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- SISTEME PLUVIALE -->
                    <li class="nav-item">
                        <a href="/sisteme-pluviale" class="nav-link <?= str_starts_with($currentUri, '/sisteme-pluviale') ? 'active' : '' ?>">
                            Sisteme pluviale <span class="arrow">&#9660;</span>
                        </a>
                        <div class="dropdown">
                            <a href="/sisteme-pluviale/metigla" class="dropdown-link">Sisteme de scurgere Metigla</a>
                            <a href="/sisteme-pluviale/flamingo-iq-budmat" class="dropdown-link">Flamingo iQ Budmat</a>
                        </div>
                    </li>

                    <!-- FERESTRE SI TAMPLARIE -->
                    <li class="nav-item">
                        <a href="/ferestre-tamplarie" class="nav-link <?= str_starts_with($currentUri, '/ferestre') ? 'active' : '' ?>">
                            Ferestre <span class="arrow">&#9660;</span>
                        </a>
                        <div class="dropdown">
                            <a href="/ferestre-tamplarie/ferestre-pvc" class="dropdown-link">Ferestre PVC</a>
                            <a href="/ferestre-tamplarie/ferestre-aluminiu" class="dropdown-link">Ferestre aluminiu</a>
                            <div class="dropdown-divider"></div>
                            <a href="/ferestre-tamplarie/ferestre-mansarda-fakro" class="dropdown-link">Ferestre mansarda FAKRO</a>
                            <a href="/ferestre-tamplarie/scari-poduri-fakro" class="dropdown-link">Scari poduri FAKRO</a>
                        </div>
                    </li>

                    <!-- IZOLATIE -->
                    <li class="nav-item">
                        <a href="/izolatie-hidroizolatii" class="nav-link <?= str_starts_with($currentUri, '/izolatie') ? 'active' : '' ?>">
                            Izolatie <span class="arrow">&#9660;</span>
                        </a>
                        <div class="dropdown">
                            <a href="/izolatie-hidroizolatii/izolatie-fibre-lemn" class="dropdown-link">Izolatie fibre lemn (STEICO Zell)</a>
                            <a href="/izolatie-hidroizolatii/hidroizolatii-terase" class="dropdown-link">Hidroizolatii terase</a>
                        </div>
                    </li>

                    <!-- GARDURI -->
                    <li class="nav-item">
                        <a href="/garduri" class="nav-link <?= $currentUri === '/garduri' ? 'active' : '' ?>">Garduri</a>
                    </li>

                    <!-- SERVICII -->
                    <li class="nav-item">
                        <a href="/servicii" class="nav-link <?= str_starts_with($currentUri, '/servicii') ? 'active' : '' ?>">
                            Servicii <span class="arrow">&#9660;</span>
                        </a>
                        <div class="dropdown">
                            <a href="/servicii/consultanta-eficienta-energetica" class="dropdown-link">Consultanta eficienta energetica</a>
                            <a href="/servicii/consultanta-passive-house" class="dropdown-link">Consultanta Passive House</a>
                        </div>
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

            <!-- CTA Button -->
            <div class="header-cta">
                <a href="tel:+40756034734" class="btn btn-primary">
                    <span class="phone-icon">&#128222;</span>
                    <span class="btn-text">Solicita oferta</span>
                </a>
            </div>

            <!-- Hamburger -->
            <button class="hamburger" id="hamburger" aria-label="Deschide meniul">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</header>

<!-- MOBILE NAV OVERLAY -->
<div class="mobile-nav-overlay" id="mobileNav">
    <ul class="mobile-nav-list">

        <!-- Acoperisuri -->
        <li class="mobile-nav-item">
            <a href="#" class="mobile-nav-link" data-toggle="mobile-acoperisuri">
                Acoperisuri <span class="arrow">&#9660;</span>
            </a>
            <div class="mobile-subnav" id="mobile-acoperisuri">
                <div class="sub-heading">Tigla metalica</div>
                <a href="/tigla-metalica/budmat">Budmat</a>
                <a href="/tigla-metalica/metigla">Metigla</a>
                <a href="/tigla-metalica/blachotrapez">Blachotrapez</a>
                <a href="/tigla-metalica/wetterbest">Wetterbest</a>
                <div class="sub-heading">Tabla faltuita</div>
                <a href="/tabla-faltuita/metigla">Metigla</a>
                <a href="/tabla-faltuita/vestalpin">Vestalpin</a>
                <a href="/tabla-faltuita/wetterbest">Wetterbest</a>
                <div class="sub-heading">Tabla click / Tabla cutata</div>
                <a href="/tabla-click/metigla">Tabla click Metigla</a>
                <a href="/tabla-cutata/metigla">Tabla cutata Metigla</a>
                <div class="sub-heading">Accesorii</div>
                <a href="/accesorii-acoperis">Accesorii acoperis</a>
                <a href="/folie-anticondens">Folie anticondens</a>
                <a href="/sipci-metalice">Sipci metalice</a>
            </div>
        </li>

        <!-- Sisteme pluviale -->
        <li class="mobile-nav-item">
            <a href="#" class="mobile-nav-link" data-toggle="mobile-pluviale">
                Sisteme pluviale <span class="arrow">&#9660;</span>
            </a>
            <div class="mobile-subnav" id="mobile-pluviale">
                <a href="/sisteme-pluviale/metigla">Sisteme de scurgere Metigla</a>
                <a href="/sisteme-pluviale/flamingo-iq-budmat">Flamingo iQ Budmat</a>
            </div>
        </li>

        <!-- Ferestre -->
        <li class="mobile-nav-item">
            <a href="#" class="mobile-nav-link" data-toggle="mobile-ferestre">
                Ferestre si tamplarie <span class="arrow">&#9660;</span>
            </a>
            <div class="mobile-subnav" id="mobile-ferestre">
                <a href="/ferestre-tamplarie/ferestre-pvc">Ferestre PVC</a>
                <a href="/ferestre-tamplarie/ferestre-aluminiu">Ferestre aluminiu</a>
                <a href="/ferestre-tamplarie/ferestre-mansarda-fakro">Ferestre mansarda FAKRO</a>
                <a href="/ferestre-tamplarie/scari-poduri-fakro">Scari poduri FAKRO</a>
            </div>
        </li>

        <!-- Izolatie -->
        <li class="mobile-nav-item">
            <a href="#" class="mobile-nav-link" data-toggle="mobile-izolatie">
                Izolatie <span class="arrow">&#9660;</span>
            </a>
            <div class="mobile-subnav" id="mobile-izolatie">
                <a href="/izolatie-hidroizolatii/izolatie-fibre-lemn">Izolatie fibre lemn (STEICO Zell)</a>
                <a href="/izolatie-hidroizolatii/hidroizolatii-terase">Hidroizolatii terase</a>
            </div>
        </li>

        <!-- Simple links -->
        <li class="mobile-nav-item">
            <a href="/garduri" class="mobile-nav-link">Garduri</a>
        </li>

        <li class="mobile-nav-item">
            <a href="#" class="mobile-nav-link" data-toggle="mobile-servicii">
                Servicii <span class="arrow">&#9660;</span>
            </a>
            <div class="mobile-subnav" id="mobile-servicii">
                <a href="/servicii/consultanta-eficienta-energetica">Consultanta eficienta energetica</a>
                <a href="/servicii/consultanta-passive-house">Consultanta Passive House</a>
            </div>
        </li>

        <li class="mobile-nav-item">
            <a href="/blog" class="mobile-nav-link">Blog</a>
        </li>

        <li class="mobile-nav-item">
            <a href="/contact" class="mobile-nav-link">Contact</a>
        </li>
    </ul>

    <div class="mobile-cta">
        <a href="tel:+40756034734" class="btn btn-primary btn-lg">
            &#128222; Suna acum: 0756.034.734
        </a>
    </div>

    <div class="mobile-contact-info">
        <p><a href="mailto:office@bdmacoperis.ro">office@bdmacoperis.ro</a></p>
        <p>Livram in toata tara</p>
    </div>
</div>
