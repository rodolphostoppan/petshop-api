<?php

require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($email, $name, $message)
{
    date_default_timezone_set('Etc/UTC');
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp-relay.brevo.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'rodolphotoppan395@gmail.com';
    $mail->Password = 'WaOwK7hn3Y4PHMI2';

    $mail->setFrom('rodolphotoppan395@gmail.com', '');
    $mail->addAddress($email, $name);
    $mail->Subject = 'Contato site';
    $mail->Body = $message;

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}