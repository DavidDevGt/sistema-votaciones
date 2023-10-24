<?php
require_once '../../models/Usuario.php';
require_once '../../lib/funciones.php';

function registrar()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo_electronico = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena'];

        if (validar_nombre_usuario($nombre_usuario)) {
            registrar_usuario($nombre_usuario, $correo_electronico, $contrasena);
            iniciar_sesion($nombre_usuario);
            header('Location: ../../views/perfil.php');
        } else {
            // Error de validacion pa despues
        }
    }
}

function iniciar_sesion($nombre_usuario)
{
    $_SESSION['nombre_usuario'] = $nombre_usuario;
}

function cerrar_sesion() {
    session_destroy();
    header('Location: ../../index.php');
}

function esta_autenticado()
{
    return isset($_SESSION['nombre_usuario']);
}