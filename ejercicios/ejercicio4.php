<?php
/**
 * Caso 4: Funciones
 * Usar la biblioteca de funciones reutilizables
 * (lib/funciones.php) para calcular la superficie
 * y el perímetro de varias figuras geométricas.
 */
require_once __DIR__ . '/../lib/funciones.php';

// 1. DATOS DE ENTRADA
// [nombre, clave, medida A, medida B, color Bootstrap]
$figuras = [
    ['Cuadrado',   'cuadrado',   10, 0, 'primary'],
    ['Rectángulo', 'rectangulo',  8, 5, 'success'],
    ['Círculo',    'circulo',     7, 0, 'warning'],
    ['Triángulo',  'triangulo',   6, 4, 'info'],
];

// 2. PROCESO: se recorre la lista y se llama a las funciones
$tarjetas = '';

foreach ($figuras as [$nombre, $clave, $a, $b, $color]) {
    $r      = calcular_figura($clave, $a, $b);
    $dibujo = dibujar_figura($clave, $a, $b);

    $area      = formatear($r['area']);
    $perimetro = '—';
    if ($r['perimetro'] !== null) {
        $perimetro = formatear($r['perimetro']);
    }

    // 3. TARJETA DE CADA FIGURA
    $tarjetas .= <<<HTML
    <div class="col">
      <div class="card h-100 text-center border-{$color}">
        <div class="card-header bg-{$color} fw-bold">
          {$nombre}
        </div>
        <div class="card-body p-2">
          {$dibujo}
          <div>Superficie: <b>{$area} m²</b></div>
          <div>Perímetro: <b>{$perimetro} m</b></div>
        </div>
      </div>
    </div>
    HTML;
}

// 4. RESULTADO EN PANTALLA
echo '<div class="row row-cols-1 row-cols-md-2 g-3">';
echo $tarjetas;
echo '</div>';
