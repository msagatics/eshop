<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= asset('icons/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= asset('icons/bootstrap-icons/bootstrap-icons.min.css'); ?>">
    <link rel="stylesheet" href="<?= asset('style.css') . '?' . time(); ?>">

    <title><?= htmlspecialchars($title); ?></title>
</head>

<body class="d-flex flex-column min-vh-100">