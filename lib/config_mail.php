<?php

use PHPMailer\PHPMailer\PHPMailer;

function obtenerConfiguracionMail() {
    $mail = new PHPMailer(true);
    
    // Configuración del servidor
    $mail->SMTPDebug = 0;                                 
    $mail->isSMTP();                                      
    $mail->Host       = 'smtp.tudominio.com';             
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'tuemail@tudominio.com';          
    $mail->Password   = 'tucontraseña';                   
    $mail->SMTPSecure = 'tls';                            
    $mail->Port       = 587;                              

    // Remitente por defecto
    $mail->setFrom('tuemail@tudominio.com', 'Nombre de Tu Sistema');

    return $mail;
}
