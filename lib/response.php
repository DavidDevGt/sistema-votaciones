<?php

/**
 * La función sendJsonResponse envía una respuesta JSON con un estado de éxito, un mensaje y datos
 * opcionales.
 * 
 * @param boolean Un valor booleano que indica si la operación fue exitosa o no.
 * @param string El parámetro "mensaje" es una cadena que representa un mensaje o descripción de la
 * respuesta. Se puede utilizar para proporcionar información adicional o contexto sobre la respuesta.
 * @param array El parámetro "datos" es un parámetro opcional que le permite incluir datos adicionales
 * en la respuesta JSON. Puede ser cualquier tipo de datos, como una matriz, un objeto o una cadena. Si
 * no proporciona un valor para el parámetro "datos", el valor predeterminado será nulo.
 */
function sendJsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json'); // Establecer el tipo de contenido a JSON
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}