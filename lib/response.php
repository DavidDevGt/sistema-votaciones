<?php

/**
 * La función sendJsonResponse envía una respuesta JSON con un estado de éxito, un mensaje y datos
 * opcionales.
 * 
 * @param boolean Un valor booleano que indica si la operación fue exitosa o no.
 * @param string El parámetro "mensaje" es una cadena que representa un mensaje o descripción de la
 * respuesta. Se puede utilizar para proporcionar información adicional o contexto sobre la respuesta.
 */
function sendJsonResponse($success, $message)
{
    header('Content-Type: application/json'); // Establecer el tipo de contenido a JSON
    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);
    exit;
}
