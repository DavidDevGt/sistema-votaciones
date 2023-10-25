<?php
// Errores PHP - Visualizar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Iniciar la sesión con PHP
define('BASE_PATH', __DIR__ . '/../../');

require_once BASE_PATH . 'models/Usuario.php';
require_once BASE_PATH . 'lib/funciones.php';
require_once BASE_PATH . 'lib/response.php';

function registrar()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validar el token CSRF
        $csrf_token = $_POST['csrf_token'];

        if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || empty($_POST['csrf_token']) || empty($_SESSION['csrf_token'])) {
            sendJsonResponse(false, 'Token CSRF no proporcionado o inválido.');
            return;
        }

        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            sendJsonResponse(false, 'Token CSRF inválido.');
            return;
        }

        $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
        $correo_electronico = htmlspecialchars($_POST['correo_electronico']);
        $contrasena = htmlspecialchars($_POST['contrasena']);

        // Validar si el usuario ya existe
        if (obtener_usuario_por_nombre($nombre_usuario)) {
            sendJsonResponse(false, 'El usuario ya existe.');
            return;
        }

        if (validar_nombre_usuario($nombre_usuario) && filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
            registrar_usuario($nombre_usuario, $correo_electronico, $contrasena);
            iniciar_sesion();
            sendJsonResponse(true, 'Registro exitoso.');
        } else {
            sendJsonResponse(false, 'Error de validación.');
        }
    } else {
        sendJsonResponse(false, 'Método no permitido.');
    }
}


function iniciar_sesion()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validar que las claves necesarias estén presentes en $_POST y $_SESSION
        if (!isset($_POST['nombre_usuario'], $_POST['contrasena'], $_POST['csrf_token'], $_SESSION['csrf_token'])) {
            sendJsonResponse(false, 'Datos incompletos.');
            return;
        }

        // Validar los datos de inicio de sesión
        $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
        $contrasena = htmlspecialchars($_POST['contrasena']);
        $csrf_token = htmlspecialchars($_POST['csrf_token']);

        // Validar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            sendJsonResponse(false, 'Token CSRF inválido.');
            return;
        }

        // Obtén el usuario de la base de datos por nombre de usuario
        $usuario = obtener_usuario_por_nombre($nombre_usuario);

        // Verifica la contraseña
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            // Inicia la sesión
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            sendJsonResponse(true, 'Inicio de sesión exitoso.');
        } else {
            // Información de inicio de sesión incorrecta
            sendJsonResponse(false, 'Nombre de usuario o contraseña incorrecta.');
        }
    } else {
        sendJsonResponse(false, 'Método no permitido.');
    }
}

function cerrar_sesion()
{
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header('Location: /'); // Esto redirige al usuario a la ruta raíz
}

function esta_autenticado()
{
    return isset($_SESSION['nombre_usuario']);
}

function handle_request() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = isset($_POST['action']) ? $_POST['action'] : null;
        switch ($action) {
            case 'register':
                registrar();
                break;
            case 'login':
                iniciar_sesion();
                break;
            default:
                sendJsonResponse(false, 'Acción no permitida.');
                break;
        }
    } else {
        sendJsonResponse(false, 'Método no permitido.');
    }
}

// Llama a la función handle_request para manejar la solicitud
handle_request();