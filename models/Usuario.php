<?php
require_once __DIR__ . '/../lib/db.php';


/**
 * La función "registrar_usuario" registra un nuevo usuario insertando su nombre de usuario, correo
 * electrónico y contraseña hash en una tabla de base de datos.
 * 
 * @param string El nombre de usuario del usuario que se está registrando.
 * @param string El parámetro "correo_electronico" representa la dirección de correo
 * electrónico del usuario.
 * @param string El parámetro "contrasena" representa la contraseña que el usuario quiere utilizar
 * para su cuenta.
 * @param int El parámetro "rol_id" representa el rol del usuario que se le asignará.
 * 
 * @return int ID del usuario que acaba de registrarse.
 */
function registrar_usuario($nombre_usuario, $correo_electronico, $contrasena, $rol_id) {
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios_registrados (nombre_usuario, correo_electronico, contrasena, rol_id) VALUES (?, ?, ?, ?)";
    return dbQueryPreparada_insert($sql, [$nombre_usuario, $correo_electronico, $contrasena_hash, $rol_id]);  // Retorna el ID del usuario recién registrado
}

/**
 * La función "obtener_usuario_por_nombre" recupera un usuario de la base de datos en función de su nombre de
 * usuario.
 * 
 * @param string El parámetro "nombre_usuario" es el nombre de usuario del usuario que queremos
 * recuperar de la base de datos.
 * 
 * @return string información del usuario de la tabla "usuarios_registrados" en la base de datos para el
 * nombre de usuario dado.
 */
function obtener_usuario_por_nombre($nombre_usuario)
{
    $sql = "SELECT * FROM usuarios_registrados WHERE nombre_usuario = ?";
    $result = dbQueryPreparada($sql, [$nombre_usuario]);
    return dbFetchAssoc($result);
}

function asignar_rol_usuario($usuario_id, $rol_id) {
    $sql = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES (?, ?)";
    dbQueryPreparada($sql, [$usuario_id, $rol_id]);
}
