<?php
/**
 * caso1.php
 * PÁGINA 2: Visualizador de Código y Resumen (Caso 1).
 */
declare(strict_types=1);

$casoId = 1;

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/funciones.php';
require_once __DIR__ . '/lib/casos.php';

$caso = obtener_caso($casoId);
$tituloPagina = "Caso {$casoId}: " . $caso['titulo'];

include_once __DIR__ . '/includes/header.php';
include_once __DIR__ . '/includes/vista_caso.php';
include_once __DIR__ . '/includes/footer.php';
