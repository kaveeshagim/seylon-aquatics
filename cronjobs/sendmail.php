<?php

require 'E:\Kavee\Documents\BIT\PROJECT 2023\Project\seylon-aquatics-project\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;   // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;     // Enable SMTP authentication
    $mail->Username = 'seylonaquaticss@gmail.com';  // SMTP username
    $mail->Password = 'ytdd qrlg uckq tsup';     // SMTP password
    $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;          // TCP port to connect to

    //Recipients
    $mail->setFrom('seylonaquaticss@gmail.com', 'Mailer');
    $mail->addAddress('kaveeshagw123456@gmail.com', 'Recipient');

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
