<?php
/**
 * index.php
 * PÁGINA 1: Menú Principal (Hub / Dashboard).
 */
declare(strict_types=1);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/lib/funciones.php';
require_once __DIR__ . '/lib/casos.php';

$tituloPagina = 'Menú Principal';
$casos = obtener_casos();

include_once __DIR__ . '/includes/header.php';
?>
<h1 class="text-center fw-bold mb-4">MENÚ PRINCIPAL</h1>

<div class="panel-caja mb-4">
    <div class="panel-titulo">RESOLUCIÓN DE EJERCICIOS</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>N°</th>
                    <th>Caso</th>
                    <th>Categoría</th>
                    <th>Enunciado detallado</th>
                    <th class="text-end">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($casos as $c): ?>
                <tr>
                    <td class="fw-bold"><?= $c['id'] ?></td>
                    <td class="fw-semibold">CASO <?= str_pad((string) $c['id'], 2, '0', STR_PAD_LEFT) ?>: <?= h($c['titulo']) ?></td>
                    <td><span class="badge text-bg-secondary"><?= h($c['categoria']) ?></span></td>
                    <td><div class="enunciado-caja py-1 px-2 small"><?= h($c['enunciado']) ?></div></td>
                    <td class="text-end"><a href="caso<?= $c['id'] ?>.php" class="btn btn-azul btn-sm">Ver caso <i class="bi bi-arrow-right"></i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="panel-caja p-3">
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">APELLIDOS Y NOMBRES:</label>
            <div class="input-group"><span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" value="<?= h(ALUMNO_NOMBRES) ?>" readonly></div>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">SEMESTRE:</label>
            <div class="input-group"><span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                <input type="text" class="form-control" value="<?= h(ALUMNO_SEMESTRE) ?>" readonly></div>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">TURNO:</label>
            <div class="input-group"><span class="input-group-text"><i class="bi bi-people"></i></span>
                <input type="text" class="form-control" value="<?= h(ALUMNO_TURNO) ?>" readonly></div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/includes/footer.php';
