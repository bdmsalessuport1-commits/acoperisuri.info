<!DOCTYPE html>
<html lang="ro">
<head>
    <?php \App\Helpers\View::partial('seo-head', get_defined_vars()); ?>

    <style>
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            background-color: var(--color-primary);
            color: var(--color-bg-white);
            padding: var(--spacing-xl);
            flex-shrink: 0;
        }

        .admin-sidebar h3 {
            color: var(--color-bg-white);
            margin-bottom: var(--spacing-lg);
            font-size: var(--text-lg);
        }

        .admin-sidebar a {
            color: rgba(255, 255, 255, 0.7);
            display: block;
            padding: var(--spacing-sm) 0;
            font-size: var(--text-sm);
        }

        .admin-sidebar a:hover {
            color: var(--color-bg-white);
            text-decoration: none;
        }

        .admin-content {
            flex: 1;
            padding: var(--spacing-xl);
            background-color: var(--color-bg-light);
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <h3>Admin Panel</h3>
            <nav>
                <a href="/admin">Dashboard</a>
                <a href="/admin/produse">Produse</a>
                <a href="/admin/categorii">Categorii</a>
                <a href="/" style="margin-top: var(--spacing-xl); display: block;">Inapoi la site</a>
            </nav>
        </aside>
        <main class="admin-content">
            <?= $content ?>
        </main>
    </div>
</body>
</html>
