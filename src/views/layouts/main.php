<!DOCTYPE html>
<html lang="ro">
<head>
    <?php \App\Helpers\View::partial('seo-head', get_defined_vars()); ?>

    <style>
        .site-main {
            min-height: calc(100vh - 200px);
        }

        /* Breadcrumb styles */
        .breadcrumb {
            background-color: var(--color-bg-light);
            padding: var(--spacing-sm) 0;
            border-bottom: 1px solid var(--color-border-light);
        }

        .breadcrumb-list {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            font-size: var(--text-sm);
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: '/';
            margin-right: var(--spacing-xs);
            color: var(--color-text-light);
        }

        .breadcrumb-item a {
            color: var(--color-accent-blue);
        }

        .breadcrumb-item span {
            color: var(--color-text-light);
        }

        /* Page placeholder */
        .page-placeholder {
            text-align: center;
            padding: var(--spacing-3xl) 0;
        }

        .page-placeholder .placeholder-icon {
            font-size: 3rem;
            margin-bottom: var(--spacing-md);
            opacity: 0.5;
        }

        .page-placeholder h2 {
            color: var(--color-primary);
        }

        .page-placeholder p {
            color: var(--color-text-light);
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php \App\Helpers\View::partial('header', get_defined_vars()); ?>

    <?php \App\Helpers\View::partial('breadcrumb', get_defined_vars()); ?>

    <main class="site-main">
        <?= $content ?>
    </main>

    <?php \App\Helpers\View::partial('footer', get_defined_vars()); ?>

    <!-- Schema.org JSON-LD -->
    <?php if (!empty($breadcrumbs)): ?>
        <?= \App\Helpers\SchemaMarkup::breadcrumbs(array_merge([['label' => 'Acasa', 'url' => '/']], $breadcrumbs)) ?>
    <?php endif; ?>
    <?php if (!empty($schemaMarkup)): ?>
        <?= $schemaMarkup ?>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="/js/header.js?v=6"></script>
</body>
</html>
