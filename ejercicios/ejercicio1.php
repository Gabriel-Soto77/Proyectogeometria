<?php
/**
 * Caso 1: Superficie del cuadrado
 * Calcular la superficie del cuadrado dado el valor
 * de uno de sus lados.
 *
 * Fórmula: S = lado × lado
 */
require_once __DIR__ . '/../lib/funciones.php';

// 1. DATOS DE ENTRADA
$lado = 10; // metros

// 2. PROCESO (funciones de lib/funciones.php)
$superficie = superficie_cuadrado($lado);
$perimetro  = perimetro_cuadrado($lado);

// 3. FORMATO DE SALIDA
$ladoTxt = formatear($lado);
$supTxt  = formatear($superficie);
$perTxt  = formatear($perimetro);

// 4. DIBUJO DE LA FIGURA A COLOR (SVG)
$dibujo = dibujar_figura('cuadrado', $lado);

// 5. RESULTADO EN PANTALLA
echo <<<HTML
<div class="text-center">
  <span class="badge text-bg-primary fs-6">CUADRADO</span>

  <div class="my-3">{$dibujo}</div>

  <div class="alert alert-primary py-2">
    Fórmula: <strong>S = lado × lado</strong>
  </div>

  <p class="mb-1">S = {$ladoTxt} × {$ladoTxt}</p>
  <p class="mb-1">Perímetro = {$perTxt} m</p>

  <p class="fs-3 fw-bold text-success">
    Superficie = {$supTxt} m²
  </p>
</div>
HTML;
