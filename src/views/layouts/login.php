<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin Login') ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo/favicon-32.png">
    <link rel="shortcut icon" href="/favicon.ico">

    <?php $v = '8'; ?>
    <link rel="stylesheet" href="/css/variables.css?v=<?= $v ?>">
    <link rel="stylesheet" href="/css/admin.css?v=<?= $v ?>">
</head>
<body class="login-body">
    <?= $content ?>
</body>
</html>
