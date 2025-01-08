<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class TemplateController
{

    /*=================================================
    Traemos la Vista Principal de la plantilla
    =================================================*/

    public function index()
    {

        include "views/template.php";
    }

    /*=================================================
    Ruta Principal o Dominio del sitio
    =================================================*/

    public static function path()
    {

        if (!empty($_SERVER["HTTPS"]) && ("on" == $_SERVER["HTTPS"])) {

            return "https://" . $_SERVER["SERVER_NAME"] . "/";
        } else {

            return "http://" . $_SERVER["SERVER_NAME"] . "/";
        }
    }

    /*=================================================
    Función para enviar correos electrónicos
    =================================================*/

    public static function sendEmail($subject, $email, $message, $link)
    {

        date_default_timezone_set("America/Argentina/Buenos_Aires");

        $mail = new PHPMailer;

        $mail->CharSet = 'utf-8';
        // $mail->Encoding = 'base64'; //Habilitar al subir el sistema a un hosting

        $mail->isMail();

        $mail->UseSendmailOptions = 0;

        $mail->setFrom("noreply@ecommerce.com", "Ecommerce");

        $mail->Subject = $subject;

        $mail->addAddress($email);

        $mail->msgHTML($message);

        $send = $mail->Send();

        if (!$send) {

            return $mail->ErrorInfo;
        } else {

            return "ok";
        }
    }
}
