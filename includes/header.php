<?php
/**
 * includes/header.php
 * Head HTML, Bootstrap 5.3 y Prism.js CSS (tema oscuro tipo VS Code).
 */
$tituloPagina = $tituloPagina ?? APP_NAME;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($tituloPagina) ?> | <?= h(APP_NAME) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Prism.js: tema VS Code Dark+ -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism-themes/1.9.0/prism-vsc-dark-plus.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css" rel="stylesheet">

    <link href="assets/css/estilos.css" rel="stylesheet">
</head>
<body>
<header class="barra-superior">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <a href="index.php" class="text-white text-decoration-none fw-bold">
            <i class="bi bi-rulers me-2"></i><?= h(APP_NAME) ?>
        </a>
        <small class="text-white-50 d-none d-md-inline"><?= h(ALUMNO_NOMBRES) ?></small>
    </div>
</header>
<main class="container py-4">
