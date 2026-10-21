<?php
/**
 * app_caso2.php
 * PÁGINA 3: Aplicación Formulario en Vivo (Caso 2).
 */
declare(strict_types=1);

$casoId = 2;

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/funciones.php';
require_once __DIR__ . '/lib/casos.php';

$caso = obtener_caso($casoId);
$tituloPagina = "Aplicación – Caso {$casoId}: " . $caso['titulo'];

include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/vista_app.php';
include_once __DIR__ . '/includes/footer.php';
