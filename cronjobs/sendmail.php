<?php

require './../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 2;   // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;     // Enable SMTP authentication
    $mail->Username = 'kaveeshagw123456@gmail.com';  // SMTP username
    $mail->Password = 'kaveeshakaveesha';     // SMTP password
    $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;          // TCP port to connect to

    //Recipients
    $mail->setFrom('kaveeshagw123456@gmail.com', 'Mailer');
    $mail->addAddress('kaveeshaw@iphonik.com', 'Recipient');

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Test Email';
    $mail->Body    = 'Email works!';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}

?>
