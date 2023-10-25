<?php
// Errores PHP - Visualizar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Iniciar la sesión con PHP
define('BASE_PATH', __DIR__ . '/../');

require_once BASE_PATH . 'models/Usuario.php';
require_once BASE_PATH . 'lib/funciones.php';
require_once BASE_PATH . 'lib/response.php';