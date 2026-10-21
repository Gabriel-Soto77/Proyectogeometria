<?php
/**
 * includes/vista_caso.php
 * PÁGINA 2: enunciado, código (izquierda), resultado (derecha) y navegación.
 * Requiere la variable $caso.
 */
$id           = $caso['id'];
$hayImgCodigo = imagen_existe($caso['img_codigo']);
$hayImgResult = imagen_existe($caso['img_resultado']);
$codigo       = leer_codigo($caso);
$salida       = ejecutar_ejercicio($caso);
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h2 fw-bold mb-0">CASO <?= $id ?>: <?= h($caso['titulo']) ?></h1>
    <a href="index.php" class="btn btn-azul"><i class="bi bi-arrow-return-left me-1"></i> VOLVER PÁG. PRINCIPAL</a>
</div>

<div class="enunciado-caja mb-3">
    <span class="badge text-bg-secondary mb-1"><?= h($caso['categoria']) ?></span><br>
    <strong>ENUNCIADO:</strong> <?= h($caso['enunciado']) ?>
</div>

<div class="row g-3">
    <!-- ===== Código (con barra para subir y bajar) ===== -->
    <div class="col-lg-6">
        <div class="panel-caja">
            <div class="panel-titulo">VISUALIZACIÓN DE CÓDIGOS (PHP)</div>
            <?php if ($hayImgCodigo): ?>
                <div class="visor-imagen">
                    <img src="<?= h($caso['img_codigo']) ?>" alt="Código del caso <?= $id ?>">
                </div>
            <?php else: ?>
                <!-- Si aún no pones la captura, se muestra el código real resaltado -->
                <div class="visor-codigo">
                    <pre class="line-numbers"><code class="language-php"><?= h($codigo) ?></code></pre>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===== Resultado de la ejecución ===== -->
    <div class="col-lg-6">
        <div class="panel-caja">
            <div class="panel-titulo">ÁREA DE RESULTADOS</div>
            <?php if ($hayImgResult): ?>
                <div class="visor-imagen visor-claro">
                    <img src="<?= h($caso['img_resultado']) ?>" alt="Resultado del caso <?= $id ?>">
                </div>
            <?php else: ?>
                <!-- Si aún no pones la captura, se muestra la ejecución real -->
                <div class="p-4 resultado-vivo"><?= $salida /* salida propia de ejercicios/, HTML confiable */ ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="d-grid mt-3">
    <a href="app_caso<?= $id ?>.php" class="btn btn-azul btn-lg">ACCEDER A LA APLICACIÓN (PAG. 3) <i class="bi bi-arrow-right-circle ms-1"></i></a>
</div>

<?= panel_navegacion($id, 'caso') ?>
