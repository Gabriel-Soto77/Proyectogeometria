<?php
/**
 * includes/vista_app.php
 * PÁGINA 3: enlace para ver la ejecución + aplicación con formulario real.
 * Requiere la variable $caso.
 */
$id    = $caso['id'];
$ver   = isset($_GET['ver']);
$datos = ($ver && $_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : [];
$res   = $datos ? calcular_caso($id, $datos) : null;
$urlApp = url_completa("app_caso{$id}.php?ver=1");
?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h1 class="h2 fw-bold mb-0">APLICACIÓN – CASO <?= $id ?>: <?= h($caso['titulo']) ?></h1>
    <a href="index.php" class="btn btn-azul"><i class="bi bi-arrow-return-left me-1"></i> VOLVER PÁG. PRINCIPAL</a>
</div>

<div class="marco-app">
<?php if (!$ver): ?>
    <div class="text-center mx-auto" style="max-width:560px">
        <div class="caja-link">
            <p class="mb-3">En esta página se encuentra el enlace para ver la ejecución de la aplicación del <strong>Caso <?= $id ?></strong>.</p>
            <a href="app_caso<?= $id ?>.php?ver=1" class="btn btn-azul btn-lg mb-3">
                <i class="bi bi-play-circle me-1"></i> Ver ejecución de la aplicación
            </a>
            <div class="input-group">
                <input type="text" class="form-control" id="urlApp" value="<?= h($urlApp) ?>" readonly>
                <button class="btn btn-outline-secondary" type="button" data-copiar="#urlApp"><i class="bi bi-clipboard"></i> Copiar enlace</button>
            </div>
            <div class="form-text">Enlace para que el profesor vea el ejercicio.</div>
        </div>
    </div>
<?php else: ?>
    <div class="mx-auto" style="max-width:620px">
        <h2 class="h5 mb-3"><?= h($caso['enunciado']) ?></h2>

        <form method="post" action="app_caso<?= $id ?>.php?ver=1" class="card card-body shadow-sm">
            <?php foreach ($caso['campos'] as $c):
                $valor = $datos[$c['name']] ?? $c['defecto']; ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="<?= h($c['name']) ?>"><?= h($c['label']) ?></label>
                    <?php if ($c['tipo'] === 'select'): ?>
                        <select class="form-select" id="<?= h($c['name']) ?>" name="<?= h($c['name']) ?>">
                            <?php foreach ($c['opciones'] as $clave => $texto): ?>
                                <option value="<?= h($clave) ?>" <?= (string) $valor === (string) $clave ? 'selected' : '' ?>><?= h($texto) ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <input type="number" step="any" min="0" class="form-control" id="<?= h($c['name']) ?>"
                               name="<?= h($c['name']) ?>" value="<?= h($valor) ?>" <?= $c['requerido'] ? 'required' : '' ?>>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-azul flex-fill">Calcular</button>
                <a href="app_caso<?= $id ?>.php?ver=1" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>

        <?php if ($res !== null): ?>
            <?php if ($res['ok']): ?>
                <div class="alert alert-success mt-3">
                    <h3 class="h6 fw-bold">Resultado</h3>
                    <dl class="row mb-0">
                        <?php foreach ($res['filas'] as $etiqueta => $valor): ?>
                            <dt class="col-sm-4"><?= h($etiqueta) ?></dt>
                            <dd class="col-sm-8 mb-1"><?= h($valor) ?></dd>
                        <?php endforeach; ?>
                    </dl>
                    <?php if (!empty($res['figura'])): ?>
                        <div class="text-center mt-3"><?= dibujar_figura(...$res['figura']) ?></div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-danger mt-3 mb-0"><?= h($res['error']) ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
</div>

<div class="d-flex flex-wrap justify-content-between gap-2 mt-3">
    <a href="caso<?= $id ?>.php" class="btn btn-azul"><i class="bi bi-arrow-left-circle me-1"></i> VOLVER A LA PÁG. ANTERIOR (CASO <?= $id ?>)</a>
    <a href="index.php" class="btn btn-azul">IR A LA PÁGINA PRINCIPAL (MENÚ) <i class="bi bi-arrow-right-circle ms-1"></i></a>
</div>

<?= panel_navegacion($id, 'app_caso') ?>
