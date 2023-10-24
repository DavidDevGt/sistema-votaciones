<?php

use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require 'config_mail.php';

/**
 * Envía un recordatorio al usuario sobre un tema próximo a expirar.
 *
 * @param string $correoDestinatario Correo electrónico del destinatario.
 * @param string $tema Nombre del tema.
 * @return void
 */
function enviar_recordatorio($correoDestinatario, $tema) {
    $mail = obtenerConfiguracionMail();

    try {
        // Recipientes
        $mail->addAddress($correoDestinatario);

        // Contenido
        $mail->isHTML(true);                                  
        $mail->Subject = "Recordatorio: El tema '$tema' está próximo a expirar";
        $mail->Body    = "<p>Hola,</p><p>Te recordamos que el tema <strong>$tema</strong> está próximo a expirar. ¡No olvides votar!</p><p>Saludos,<br>Equipo de VotaSimple</p>";

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el recordatorio: {$mail->ErrorInfo}";
    }
}

/**
 * Envía un correo al usuario con un enlace para cambiar su contraseña.
 *
 * @param string $correoDestinatario Correo electrónico del destinatario.
 * @return void
 */
function enviar_enlace_cambio_contrasena($correoDestinatario) {
    $token = generar_token();

    // Aquí deberías guardar el token en la base de datos asociado al usuario.
    // Esto te permitirá verificar el token cuando el usuario haga clic en el enlace.

    $mail = obtenerConfiguracionMail();

    try {
        // Recipientes
        $mail->addAddress($correoDestinatario);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = "Solicitud de cambio de contraseña";
        $enlace = "https://tusitio.com/cambiar_contrasena?token=" . $token;
        $mail->Body    = "<p>Hola,</p><p>Has solicitado cambiar tu contraseña. Haz clic en el siguiente enlace para establecer una nueva contraseña:</p><p><a href='$enlace'>$enlace</a></p><p>Si no has solicitado este cambio, ignora este correo.</p><p>Saludos,<br>Equipo de VotaSimple</p>";

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el correo para cambio de contraseña: {$mail->ErrorInfo}";
    }
}
