<?php
/**
 * lib/casos.php
 * Biblioteca centralizada de casos + ayudas de navegación y visualización.
 */
declare(strict_types=1);

function obtener_casos(): array
{
    return [
        1 => [
            'id' => 1, 'titulo' => 'Superficie del Cuadrado', 'categoria' => 'Geometría plana',
            'enunciado' => 'Calcular la superficie del cuadrado dado el valor de uno de sus lados de 10 metros.',
            'archivo' => 'ejercicios/ejercicio1.php',
            'img_codigo' => 'assets/img/caso1_codigo.png', 'img_resultado' => 'assets/img/caso1_resultado.png',
            'campos' => [
                ['name' => 'lado', 'label' => 'Lado del cuadrado (m)', 'tipo' => 'number', 'defecto' => 10, 'requerido' => true],
            ],
        ],
        2 => [
            'id' => 2, 'titulo' => 'Superficie del Rectángulo', 'categoria' => 'Geometría plana',
            'enunciado' => 'Calcular la superficie de un rectángulo dados los valores de su base (8 m) y su altura (5 m).',
            'archivo' => 'ejercicios/ejercicio2.php',
            'img_codigo' => 'assets/img/caso2_codigo.png', 'img_resultado' => 'assets/img/caso2_resultado.png',
            'campos' => [
                ['name' => 'base',   'label' => 'Base (m)',   'tipo' => 'number', 'defecto' => 8, 'requerido' => true],
                ['name' => 'altura', 'label' => 'Altura (m)', 'tipo' => 'number', 'defecto' => 5, 'requerido' => true],
            ],
        ],
        3 => [
            'id' => 3, 'titulo' => 'Superficie del Círculo', 'categoria' => 'Geometría plana',
            'enunciado' => 'Calcular la superficie de un círculo dado el valor de su radio de 7 metros.',
            'archivo' => 'ejercicios/ejercicio3.php',
            'img_codigo' => 'assets/img/caso3_codigo.png', 'img_resultado' => 'assets/img/caso3_resultado.png',
            'campos' => [
                ['name' => 'radio', 'label' => 'Radio (m)', 'tipo' => 'number', 'defecto' => 7, 'requerido' => true],
            ],
        ],
        4 => [
            'id' => 4, 'titulo' => 'Funciones', 'categoria' => 'Funciones y reutilización',
            'enunciado' => 'Crear una biblioteca de funciones reutilizables (lib/funciones.php), incluirla con require_once y utilizarla para calcular la superficie y el perímetro de distintas figuras geométricas.',
            'archivo' => 'ejercicios/ejercicio4.php',
            'img_codigo' => 'assets/img/caso4_codigo.png', 'img_resultado' => 'assets/img/caso4_resultado.png',
            'campos' => [
                ['name' => 'figura', 'label' => 'Figura', 'tipo' => 'select', 'defecto' => 'cuadrado', 'requerido' => true,
                 'opciones' => ['cuadrado' => 'Cuadrado', 'rectangulo' => 'Rectángulo', 'circulo' => 'Círculo', 'triangulo' => 'Triángulo']],
                ['name' => 'a', 'label' => 'Medida A (lado, base o radio)', 'tipo' => 'number', 'defecto' => 10, 'requerido' => true],
                ['name' => 'b', 'label' => 'Medida B (altura: rectángulo / triángulo)', 'tipo' => 'number', 'defecto' => 5, 'requerido' => false],
            ],
        ],
    ];
}

function obtener_caso(int $id): array
{
    $casos = obtener_casos();
    if (!isset($casos[$id])) {
        http_response_code(404);
        exit('Caso no encontrado.');
    }
    return $casos[$id];
}

function caso_anterior(int $id): ?array  { return obtener_casos()[$id - 1] ?? null; }
function caso_siguiente(int $id): ?array { return obtener_casos()[$id + 1] ?? null; }

function leer_codigo(array $caso): string
{
    $ruta = BASE_PATH . '/' . $caso['archivo'];
    return is_file($ruta) ? (string) file_get_contents($ruta) : '// Archivo no encontrado: ' . $caso['archivo'];
}

/** Ejecuta el ejercicio y devuelve lo que imprime (para mostrarlo en vivo). */
function ejecutar_ejercicio(array $caso): string
{
    ob_start();
    try {
        include BASE_PATH . '/' . $caso['archivo'];
    } catch (Throwable $e) {
        echo 'Error: ' . h($e->getMessage());
    }
    return (string) ob_get_clean();
}

function imagen_existe(string $rel): bool
{
    return is_file(BASE_PATH . '/' . $rel);
}

/** URL pública completa de una página del proyecto (para el link del profesor). */
function url_completa(string $pagina): string
{
    if (LINK_PUBLICO !== '') {
        return rtrim(LINK_PUBLICO, '/') . '/' . $pagina;
    }
    $https   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    $host    = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $carpeta = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    return ($https ? 'https' : 'http') . '://' . $host . $carpeta . '/' . $pagina;
}

/**
 * Panel de control: Menú Principal / Caso Anterior / Caso Siguiente.
 * $prefijo = 'caso' (página 2) o 'app_caso' (página 3)
 */
function panel_navegacion(int $id, string $prefijo = 'caso'): string
{
    $ant = caso_anterior($id);
    $sig = caso_siguiente($id);

    $html  = '<nav class="d-flex flex-wrap gap-2 justify-content-between align-items-center mt-4" aria-label="Navegación de casos">';
    $html .= $ant
        ? '<a class="btn btn-outline-secondary" href="' . $prefijo . $ant['id'] . '.php">&larr; Caso Anterior</a>'
        : '<span class="btn btn-outline-secondary disabled">&larr; Caso Anterior</span>';
    $html .= '<a class="btn btn-azul" href="index.php">Menú Principal</a>';
    $html .= $sig
        ? '<a class="btn btn-outline-secondary" href="' . $prefijo . $sig['id'] . '.php">Caso Siguiente &rarr;</a>'
        : '<span class="btn btn-outline-secondary disabled">Caso Siguiente &rarr;</span>';
    $html .= '</nav>';
    return $html;
}
