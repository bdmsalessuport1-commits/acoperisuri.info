<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin') ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo/favicon-32.png">
    <link rel="shortcut icon" href="/favicon.ico">

    <?php $v = '9'; ?>
    <link rel="stylesheet" href="/css/variables.css?v=<?= $v ?>">
    <link rel="stylesheet" href="/css/admin.css?v=<?= $v ?>">
</head>
<body>
    <?php
    $adminUser = \App\Helpers\Auth::user();
    $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $currentPath = rtrim($currentPath, '/') ?: '/admin';
    ?>

    <div class="admin-wrapper">
        <!-- SIDEBAR -->
        <aside class="admin-sidebar">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">BDM</div>
                <span class="sidebar-logo-text">Admin Panel</span>
            </div>

            <nav class="sidebar-nav">
                <div class="sidebar-section">
                    <span class="sidebar-section-label">Principal</span>
                    <a href="/admin" class="sidebar-link<?= $currentPath === '/admin' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9632;</span>
                        Dashboard
                    </a>
                </div>

                <div class="sidebar-section">
                    <span class="sidebar-section-label">Continut</span>
                    <a href="/admin/categorii" class="sidebar-link<?= str_starts_with($currentPath, '/admin/categorii') ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9776;</span>
                        Categorii
                    </a>
                    <a href="/admin/subcategorii" class="sidebar-link<?= str_starts_with($currentPath, '/admin/subcategorii') ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9655;</span>
                        Subcategorii
                    </a>
                    <a href="/admin/produse" class="sidebar-link<?= str_starts_with($currentPath, '/admin/produse') ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9733;</span>
                        Produse
                    </a>
                    <a href="/admin/blog" class="sidebar-link<?= $currentPath === '/admin/blog' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9998;</span>
                        Blog
                    </a>
                    <a href="/admin/videouri" class="sidebar-link<?= $currentPath === '/admin/videouri' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9654;</span>
                        Videouri TikTok
                    </a>
                    <a href="/admin/media" class="sidebar-link<?= $currentPath === '/admin/media' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9634;</span>
                        Media
                    </a>
                </div>

                <div class="sidebar-section">
                    <span class="sidebar-section-label">Marketing</span>
                    <a href="/admin/seo" class="sidebar-link<?= $currentPath === '/admin/seo' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9906;</span>
                        SEO
                    </a>
                    <a href="/admin/homepage" class="sidebar-link<?= $currentPath === '/admin/homepage' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9750;</span>
                        Homepage
                    </a>
                    <a href="/admin/mesaje" class="sidebar-link<?= $currentPath === '/admin/mesaje' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9993;</span>
                        Mesaje / Lead-uri
                    </a>
                </div>

                <div class="sidebar-section">
                    <span class="sidebar-section-label">Sistem</span>
                    <a href="/admin/utilizatori" class="sidebar-link<?= $currentPath === '/admin/utilizatori' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9679;</span>
                        Utilizatori
                    </a>
                    <a href="/admin/setari" class="sidebar-link<?= $currentPath === '/admin/setari' ? ' active' : '' ?>">
                        <span class="sidebar-icon">&#9881;</span>
                        Setari
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <a href="/" class="sidebar-link" target="_blank">
                    <span class="sidebar-icon">&#8599;</span>
                    Vezi site-ul
                </a>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="admin-main">
            <!-- HEADER -->
            <header class="admin-header">
                <div class="admin-header-left">
                    <h2 class="admin-page-title"><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?></h2>
                </div>
                <div class="admin-header-right">
                    <div class="admin-user-info">
                        <div class="admin-user-avatar"><?= mb_strtoupper(mb_substr($adminUser['name'] ?? 'A', 0, 1)) ?></div>
                        <div class="admin-user-details">
                            <span class="admin-user-name"><?= htmlspecialchars($adminUser['name'] ?? 'Admin') ?></span>
                            <span class="admin-user-role"><?= htmlspecialchars(ucfirst($adminUser['role'] ?? 'admin')) ?></span>
                        </div>
                    </div>
                    <a href="/admin/logout" class="admin-logout-btn">Logout</a>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="admin-content">
                <?= $content ?>
            </main>
        </div>
    </div>
</body>
</html>
