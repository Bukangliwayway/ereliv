<?php
include '../db/db.php';
include '../db/queries.php';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../mail/Exception.php';
require '../mail/SMTP.php';
require '../mail/PHPMailer.php';

$mail = new PHPMailer(true);
    // password = erelivadmin2023
try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'erelivsmtpmailer@gmail.com';                     //SMTP username
    $mail->Password   = 'rizzsvztalpdbwjq';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('erelivsmtpmailer@gmail.com', 'Admin');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PUPQC Research Paper Management Reset Password';
    $mail->Body    = '';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}