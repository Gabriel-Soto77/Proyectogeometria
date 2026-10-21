<?php
/**
 * Caso 2: Superficie del rectángulo
 * Calcular la superficie de un rectángulo dados
 * los valores de su base y su altura.
 *
 * Fórmula: S = base × altura
 */
require_once __DIR__ . '/../lib/funciones.php';

// 1. DATOS DE ENTRADA
$base   = 8; // metros
$altura = 5; // metros

// 2. PROCESO (funciones de lib/funciones.php)
$superficie = superficie_rectangulo($base, $altura);
$perimetro  = perimetro_rectangulo($base, $altura);

// 3. FORMATO DE SALIDA
$baseTxt = formatear($base);
$altTxt  = formatear($altura);
$supTxt  = formatear($superficie);
$perTxt  = formatear($perimetro);

// 4. DIBUJO DE LA FIGURA A COLOR (SVG)
$dibujo = dibujar_figura('rectangulo', $base, $altura);

// 5. RESULTADO EN PANTALLA
echo <<<HTML
<div class="text-center">
  <span class="badge text-bg-success fs-6">RECTÁNGULO</span>

  <div class="my-3">{$dibujo}</div>

  <div class="alert alert-success py-2">
    Fórmula: <strong>S = base × altura</strong>
  </div>

  <p class="mb-1">S = {$baseTxt} × {$altTxt}</p>
  <p class="mb-1">Perímetro = {$perTxt} m</p>

  <p class="fs-3 fw-bold text-success">
    Superficie = {$supTxt} m²
  </p>
</div>
HTML;
