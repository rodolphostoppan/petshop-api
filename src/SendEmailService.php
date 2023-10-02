<?php

namespace src\SendEmailService;


class SendEmailService
{
    public function send(string $email, string $name): void
    {
        $message = 'Estaremos entrando em contato por ligação ou enviando uma mensagem no WhatsApp';

        date_default_timezone_set('Etc/UTC');

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
        $mail->send();
    }
}