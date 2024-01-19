<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!function_exists('sendMail')) {
    function sendEmail($mailconfig)
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = getenv('email_host');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('email_user');
        $mail->Password = getenv('email_pass');
        $mail->SMTPSecure = getenv('email_encryption');
        $mail->Port = getenv('email_port');
        $mail->setFrom($mailconfig['mail_from_email'], $mailconfig['mail_from_name']);
        $mail->addAddress($mailconfig['mail_recipient_email'], $mailconfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailconfig['mail_subject'];
        $mail->Body = $mailconfig['mail_body'];
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}
