<?php
/**
 * config/app.php
 * Variables globales y zona horaria del proyecto.
 */
declare(strict_types=1);

date_default_timezone_set('America/Lima');

define('APP_NAME', 'Proyecto Geometría');
define('BASE_PATH', dirname(__DIR__));

// ====== EDITA TUS DATOS AQUÍ (se muestran en el Menú Principal) ======
define('ALUMNO_NOMBRES',  'Apellidos y Nombres del alumno');
define('ALUMNO_SEMESTRE', 'Semestre');
define('ALUMNO_TURNO',    'Turno');

// Si subes el proyecto a un hosting, escribe aquí la URL pública base.
// Ejemplo: 'https://midominio.com/proyecto_geometria'
// Déjalo vacío para que se detecte automáticamente.
define('LINK_PUBLICO', '');
