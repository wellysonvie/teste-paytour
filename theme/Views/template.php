<!doctype html>
<html lang="pt-br" class="h-100">

<head>
    <title><?= APP ?></title>
    <link rel="shortcut icon" href="<?= url('theme/img/company/favicon.png') ?>" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= url("theme/css/bootstrap.min.css") ?>">

    <link rel="stylesheet" href="<?= url("theme/css/global.css") ?>">

    <?php foreach ($styles as $style) : ?>
        <link rel="stylesheet" href="<?= url("theme/css/" . $style) ?>">
    <?php endforeach; ?>
</head>

<body class="d-flex flex-column h-100 bg-light">

    <nav class="navbar fixed-top navbar-expand-lg navbar-light navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" style="font-family: 'Krona One', sans-serif; font-weight: 400" href="<?= url('') ?>"><b><?= APP ?></b></a>
        </div>
    </nav>

    <?php
    include __DIR__ . "/{$view}";
    ?>

    <div class="footer-copyright mt-auto text-center py-3 bg-white">
        <span class="text-muted">&copy; <?= date("Y") ?> <?= APP ?> | Desenvolvido por </span>
        <a target="_blank" class="text-black-50" href="mailto:wellysonvie@gmail.com">Wellyson Vieira</a>
    </div>

    <script src="<?= url("theme/js/jquery-3.3.1.min.js") ?>"></script>
    <script src="<?= url("theme/js/jquery.mask.min.js") ?>"></script>
    <script src="<?= url("theme/js/popper.min.js") ?>"></script>
    <script src="<?= url("theme/js/bootstrap.min.js") ?>"></script>

    <script src="<?= url("theme/js/scripts.js") ?>"></script>

    <?php foreach ($scripts as $script) : ?>
        <script src="<?= url("theme/js/" . $script) ?>"></script>
    <?php endforeach; ?>

</body>

</html>