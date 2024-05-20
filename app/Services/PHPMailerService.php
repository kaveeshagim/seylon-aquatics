<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class PHPMailerService
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $config = config('phpmailer');

        $this->mail->isSMTP();
        $this->mail->Host = $config['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $config['username'];
        $this->mail->Password = $config['password'];
        $this->mail->SMTPSecure = $config['encryption'];
        $this->mail->Port = $config['port'];
        $this->mail->setFrom($config['from_address'], $config['from_name']);
    }

    public function sendEmail($to, $subject, $body)
    {
        try {
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            Log::error("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
            return false;
        }
    }
}
