<!DOCTYPE html>
<html lang="ro">
<head>
    <?php \App\Helpers\View::partial('seo-head', get_defined_vars()); ?>
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
    <script src="/js/app.min.js?v=11" defer></script>
</body>
</html>
