<?php
// Errores PHP - Visualizar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Iniciar la sesión con PHP
require_once __DIR__ . '/../../models/Usuario.php';
require_once __DIR__ . '/../../lib/funciones.php';
require_once __DIR__ . '/../../lib/response.php';

function registrar()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo_electronico = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena'];

        // Validar si el usuario ya existe
        if (obtener_usuario_por_nombre($nombre_usuario)) {
            sendJsonResponse(false, 'El usuario ya existe.');
            return;
        }

        if (validar_nombre_usuario($nombre_usuario) && filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
            registrar_usuario($nombre_usuario, $correo_electronico, $contrasena);
            iniciar_sesion($nombre_usuario);
            sendJsonResponse(true, 'Registro exitoso.');
        } else {
            sendJsonResponse(false, 'Error de validación.');
        }
    } else {
        sendJsonResponse(false, 'Método no permitido.');
    }
}

function iniciar_sesion($nombre_usuario)
{
    $_SESSION['nombre_usuario'] = $nombre_usuario;
}

function cerrar_sesion()
{
    session_unset(); // Eliminar todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header('Location: ../../index.php');
}

function esta_autenticado()
{
    return isset($_SESSION['nombre_usuario']);
}

// Llama a la función registrar cuando se accede al archivo
registrar();
