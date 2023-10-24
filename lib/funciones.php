<?php
/**
 * Genera un token de acceso único para una elección.
 *
 * @return string Token de acceso único.
 */
function generar_token()
{
    return bin2hex(random_bytes(10));
}

/**
 * Calcula el porcentaje de votos de una opción.
 *
 * @param int $votosOpcion Número de votos de la opción.
 * @param int $votosTotales Número total de votos.
 * @return float Porcentaje de votos.
 */
function calcular_porcentaje_votos($votosOpcion, $votosTotales)
{
    if ($votosTotales == 0) {
        return 0;
    }
    return ($votosOpcion / $votosTotales) * 100;
}

/**
 * Verifica si el token de acceso es válido.
 *
 * @param string $token Token proporcionado.
 * @param string $tokenReal Token real almacenado.
 * @return bool Verdadero si es válido, falso en caso contrario.
 */
function verificar_token($token, $tokenReal)
{
    return hash_equals($token, $tokenReal);
}

/**
 * Genera un enlace único para compartir la elección.
 *
 * @param string $token Token de la elección.
 * @return string Enlace único.
 */
function generar_enlace_votacion($token)
{
    return "https://tusitio.com/votar?token=" . $token;
}

/**
 * Valida que el nombre de usuario solo contenga caracteres permitidos.
 *
 * @param string $nombreUsuario Nombre de usuario.
 * @return bool Verdadero si es válido, falso en caso contrario.
 */
function validar_nombre_usuario($nombreUsuario)
{
    return preg_match('/^[a-zA-Z0-9_]{5,20}$/', $nombreUsuario);
}

/**
 * Genera un enlace para compartir en redes sociales.
 *
 * @param string $url URL del tema.
 * @param string $redSocial Red social ('facebook', 'twitter', etc.).
 * @return string URL para compartir.
 */
function generar_enlace_red_social($url, $redSocial)
{
    switch ($redSocial) {
        case 'facebook':
            return "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($url);
        case 'twitter':
            return "https://twitter.com/intent/tweet?url=" . urlencode($url);
            // ... otros casos para otras redes sociales.
        default:
            return $url;
    }
}
