<?php

/***************************
 * CONFIGURACIÓN GENERAL
 ***************************/
define('APP_NAME', 'Agenda Eloquent');
define('BASE_URL', 'http://localhost/agenda-eloquent/');

/***************************
 * BASE DE DATOS
 ***************************/
define('DB_DRIVER', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'AgendaEloquent');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATION', 'utf8mb4_unicode_ci');

/***************************
 * SESIONES
 ***************************/
define('SESSION_NAME', 'agenda_session');
define('SESSION_LIFETIME', 3600);

/***************************
 * SEGURIDAD
 ***************************/
define('PASSWORD_ALGO', PASSWORD_DEFAULT);
define('PASSWORD_OPTIONS', []);

/***************************
 * RUTAS
 ***************************/
define('PATH_ROOT', __DIR__ . '/../');
define('PATH_SRC', PATH_ROOT . 'src/');
define('PATH_VENDOR', PATH_ROOT . 'vendor/');

/***************************
 * INICIALIZACIÓN
 ***************************/
session_name(SESSION_NAME);
session_start();
