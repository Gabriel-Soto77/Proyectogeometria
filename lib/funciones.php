<?php
/**
 * lib/funciones.php
 * Lógica matemática de cálculo (funciones reutilizables).
 */
declare(strict_types=1);

/* ---------- Superficies ---------- */
function superficie_cuadrado(float $lado): float
{
    return $lado * $lado;
}

function superficie_rectangulo(float $base, float $altura): float
{
    return $base * $altura;
}

function superficie_circulo(float $radio): float
{
    return M_PI * $radio ** 2;
}

function superficie_triangulo(float $base, float $altura): float
{
    return ($base * $altura) / 2;
}

/* ---------- Perímetros ---------- */
function perimetro_cuadrado(float $lado): float
{
    return 4 * $lado;
}

function perimetro_rectangulo(float $base, float $altura): float
{
    return 2 * ($base + $altura);
}

function perimetro_circulo(float $radio): float
{
    return 2 * M_PI * $radio;
}

/**
 * Calcula superficie y perímetro de una figura.
 * @return array{area: float, perimetro: ?float}
 */
function calcular_figura(string $figura, float $a, float $b = 0.0): array
{
    return match ($figura) {
        'cuadrado'   => ['area' => superficie_cuadrado($a),       'perimetro' => perimetro_cuadrado($a)],
        'rectangulo' => ['area' => superficie_rectangulo($a, $b), 'perimetro' => perimetro_rectangulo($a, $b)],
        'circulo'    => ['area' => superficie_circulo($a),        'perimetro' => perimetro_circulo($a)],
        'triangulo'  => ['area' => superficie_triangulo($a, $b),  'perimetro' => null],
        default      => throw new InvalidArgumentException("Figura no válida: {$figura}"),
    };
}

/* ---------- Utilidades ---------- */
function formatear(float $n, int $decimales = 2): string
{
    return number_format($n, $decimales, '.', ',');
}

/** Devuelve el número si es válido y mayor que 0; si no, null. */
function validar_positivo(mixed $valor): ?float
{
    $valor = str_replace(',', '.', trim((string) $valor));
    return (is_numeric($valor) && (float) $valor > 0) ? (float) $valor : null;
}

/** Escapa texto para imprimirlo en HTML. */
function h(mixed $texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

/**
 * Procesa los datos del formulario de cada caso.
 * @return array{ok: bool, error?: string, filas?: array<string,string>}
 */
function calcular_caso(int $id, array $d): array
{
    $err = fn(string $m): array => ['ok' => false, 'error' => $m];

    switch ($id) {
        case 1:
            $lado = validar_positivo($d['lado'] ?? null);
            if ($lado === null) return $err('Ingrese un lado mayor que 0.');
            return ['ok' => true, 'filas' => [
                'Lado'       => formatear($lado) . ' m',
                'Superficie' => formatear(superficie_cuadrado($lado)) . ' m²',
            ], 'figura' => ['cuadrado', $lado]];

        case 2:
            $base   = validar_positivo($d['base'] ?? null);
            $altura = validar_positivo($d['altura'] ?? null);
            if ($base === null || $altura === null) return $err('Ingrese base y altura mayores que 0.');
            return ['ok' => true, 'filas' => [
                'Base'       => formatear($base) . ' m',
                'Altura'     => formatear($altura) . ' m',
                'Superficie' => formatear(superficie_rectangulo($base, $altura)) . ' m²',
            ], 'figura' => ['rectangulo', $base, $altura]];

        case 3:
            $radio = validar_positivo($d['radio'] ?? null);
            if ($radio === null) return $err('Ingrese un radio mayor que 0.');
            return ['ok' => true, 'filas' => [
                'Radio'      => formatear($radio) . ' m',
                'Superficie' => formatear(superficie_circulo($radio)) . ' m²',
            ], 'figura' => ['circulo', $radio]];

        case 4:
            $figura = (string) ($d['figura'] ?? '');
            $a = validar_positivo($d['a'] ?? null);
            $b = validar_positivo($d['b'] ?? null);
            if ($a === null) return $err('Ingrese la medida A mayor que 0.');
            if (in_array($figura, ['rectangulo', 'triangulo'], true) && $b === null) {
                return $err('Esta figura necesita también la medida B mayor que 0.');
            }
            try {
                $r = calcular_figura($figura, $a, $b ?? 0.0);
            } catch (InvalidArgumentException $e) {
                return $err($e->getMessage());
            }
            return ['ok' => true, 'filas' => [
                'Figura'     => ['cuadrado'=>'Cuadrado','rectangulo'=>'Rectángulo','circulo'=>'Círculo','triangulo'=>'Triángulo'][$figura],
                'Superficie' => formatear($r['area']) . ' m²',
                'Perímetro'  => $r['perimetro'] === null ? '—' : formatear($r['perimetro']) . ' m',
            ], 'figura' => [$figura, $a, $b ?? 0.0]];
    }
    return $err('Caso no encontrado.');
}


/* ---------- Dibujo de figuras a color (SVG) ---------- */

/** Número sin ceros sobrantes: 10.00 -> 10 ; 7.50 -> 7.5 */
function num_corto(float $n): string
{
    return rtrim(rtrim(number_format($n, 2, '.', ''), '0'), '.');
}

/**
 * Devuelve un SVG a color de la figura, con sus medidas.
 * cuadrado(a=lado) | rectangulo(a=base, b=altura) | circulo(a=radio) | triangulo(a=base, b=altura)
 */
function dibujar_figura(string $figura, float $a, float $b = 0.0): string
{
    $t = 'font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="#343a40"';
    $svg = '<svg viewBox="0 0 260 175" width="100%" style="max-width:260px" xmlns="http://www.w3.org/2000/svg" role="img">';

    switch ($figura) {
        case 'cuadrado':
            $x = 50; $y = 12; $s = 120;
            $svg .= "<rect x=\"$x\" y=\"$y\" width=\"$s\" height=\"$s\" rx=\"6\" fill=\"#74c0fc\" stroke=\"#1c7ed6\" stroke-width=\"4\"/>";
            $svg .= '<text x="' . ($x + $s / 2) . '" y="' . ($y + $s + 24) . '" text-anchor="middle" ' . $t . '>' . num_corto($a) . ' m</text>';
            $svg .= '<text x="' . ($x + $s + 10) . '" y="' . ($y + $s / 2 + 5) . '" ' . $t . '>' . num_corto($a) . ' m</text>';
            break;

        case 'rectangulo':
            $e = min(160 / $a, 110 / $b);
            $w = $a * $e; $h = $b * $e; $x = 20; $y = 12;
            $svg .= "<rect x=\"$x\" y=\"$y\" width=\"$w\" height=\"$h\" rx=\"6\" fill=\"#8ce99a\" stroke=\"#2f9e44\" stroke-width=\"4\"/>";
            $svg .= '<text x="' . ($x + $w / 2) . '" y="' . ($y + $h + 24) . '" text-anchor="middle" ' . $t . '>base = ' . num_corto($a) . ' m</text>';
            $svg .= '<text x="' . ($x + $w + 10) . '" y="' . ($y + $h / 2 + 5) . '" ' . $t . '>' . num_corto($b) . ' m</text>';
            break;

        case 'circulo':
            $cx = 110; $cy = 82; $r = 68;
            $svg .= "<circle cx=\"$cx\" cy=\"$cy\" r=\"$r\" fill=\"#ffd8a8\" stroke=\"#f76707\" stroke-width=\"4\"/>";
            $svg .= '<line x1="' . $cx . '" y1="' . $cy . '" x2="' . ($cx + $r) . '" y2="' . $cy . '" stroke="#d9480f" stroke-width="3" stroke-dasharray="6 4"/>';
            $svg .= '<circle cx="' . $cx . '" cy="' . $cy . '" r="4" fill="#d9480f"/>';
            $svg .= '<text x="' . ($cx + $r / 2) . '" y="' . ($cy - 8) . '" text-anchor="middle" ' . $t . '>r = ' . num_corto($a) . ' m</text>';
            break;

        case 'triangulo':
            $e = min(160 / $a, 110 / $b);
            $w = $a * $e; $h = $b * $e; $x = 20; $y = 12;
            $pts = $x . ',' . ($y + $h) . ' ' . ($x + $w) . ',' . ($y + $h) . ' ' . ($x + $w / 2) . ',' . $y;
            $svg .= "<polygon points=\"$pts\" fill=\"#eebefa\" stroke=\"#ae3ec9\" stroke-width=\"4\" stroke-linejoin=\"round\"/>";
            $svg .= '<line x1="' . ($x + $w / 2) . '" y1="' . $y . '" x2="' . ($x + $w / 2) . '" y2="' . ($y + $h) . '" stroke="#862e9c" stroke-width="3" stroke-dasharray="6 4"/>';
            $svg .= '<text x="' . ($x + $w / 2) . '" y="' . ($y + $h + 24) . '" text-anchor="middle" ' . $t . '>base = ' . num_corto($a) . ' m</text>';
            $svg .= '<text x="' . ($x + $w / 2 + 8) . '" y="' . ($y + $h * 0.72) . '" ' . $t . '>h = ' . num_corto($b) . ' m</text>';
            break;

        default:
            $svg .= '<text x="10" y="40" ' . $t . '>Figura no válida</text>';
    }
    return $svg . '</svg>';
}
