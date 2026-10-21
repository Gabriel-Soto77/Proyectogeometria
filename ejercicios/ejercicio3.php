<?php
/**
 * Caso 3: Superficie del círculo
 * Calcular la superficie de un círculo dado el
 * valor de su radio.
 *
 * Fórmula: S = π × radio²
 */
require_once __DIR__ . '/../lib/funciones.php';

// 1. DATOS DE ENTRADA
$radio = 7; // metros

// 2. PROCESO (funciones de lib/funciones.php)
$superficie = superficie_circulo($radio);
$perimetro  = perimetro_circulo($radio);

// 3. FORMATO DE SALIDA
$piTxt    = formatear(M_PI, 4);
$radioTxt = formatear($radio);
$supTxt   = formatear($superficie);
$perTxt   = formatear($perimetro);

// 4. DIBUJO DE LA FIGURA A COLOR (SVG)
$dibujo = dibujar_figura('circulo', $radio);

// 5. RESULTADO EN PANTALLA
echo <<<HTML
<div class="text-center">
  <span class="badge text-bg-warning fs-6">CÍRCULO</span>

  <div class="my-3">{$dibujo}</div>

  <div class="alert alert-warning py-2">
    Fórmula: <strong>S = π × radio²</strong>
  </div>

  <p class="mb-1">S = {$piTxt} × {$radioTxt}²</p>
  <p class="mb-1">Perímetro = {$perTxt} m</p>

  <p class="fs-3 fw-bold text-success">
    Superficie = {$supTxt} m²
  </p>
</div>
HTML;
