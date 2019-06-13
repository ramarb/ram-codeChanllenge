<?php
/**
 * Created by PhpStorm.
 * User: dgl
 * Date: 5/23/19
 * Time: 2:15 PM
 */

namespace App\Lib;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MyMail{

    public static function send($to, $toName, $subject, $body){

        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.zoho.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'ram.abarquez@zoho.com';                     // SMTP username
            $mail->Password   = 'Dp:Uf-EA6vgHa5H';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($mail->Username, 'Site Admin');
            $mail->addAddress($to, $toName);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($mail->Username, 'Site Admin');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $body;

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

    public static function simpleMail($to, $subject, $body){
        //$subject = "this is a subject";
        $message = $body;


        $headers = '';

        $headers .= "Reply-To: WDDS ADMIN <admin@wdds.com>\r\n";
        $headers .= "Return-Path: WDDS ADMIN <admin@wdds.com>\r\n";
        $headers .= "From: WDDS ADMIN <admin@wdds.com>\r\n";
        $headers .= "Organization: WDDS\r\n";

        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;



        mail($to, $subject, $message, $headers);
    }
}