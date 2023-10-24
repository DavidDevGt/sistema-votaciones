<?php
require_once __DIR__ . '/../lib/db.php';

/**
 * La función "registrar_usuario" toma un nombre de usuario, correo electrónico y contraseña, codifica
 * la contraseña e inserta la información del usuario en una tabla de base de datos.
 * 
 * @param string El parámetro "nombre_usuario" es el nombre de usuario del usuario que se está
 * registrando.
 * @param string El parámetro "correo_electronico" representa la dirección de correo
 * electrónico del usuario que se está registrando.
 * @param string El parámetro "contrasena" representa la contraseña que el usuario quiere utilizar
 * para su cuenta.
 */
function registrar_usuario($nombre_usuario, $correo_electronico, $contrasena) {
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios_registrados (nombre_usuario, correo_electronico, contrasena) VALUES (?, ?, ?)";
    dbQueryPreparada($sql, [$nombre_usuario, $correo_electronico, $contrasena_hash]);
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
function obtener_usuario_por_nombre($nombre_usuario) {
    $sql = "SELECT * FROM usuarios_registrados WHERE nombre_usuario = ?";
    $result = dbQueryPreparada($sql, [$nombre_usuario]);
    return dbFetchAssoc($result);
}