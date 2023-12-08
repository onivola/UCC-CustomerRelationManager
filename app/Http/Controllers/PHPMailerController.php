<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerController extends Controller
{
    // =============== [ Email ] ===================
    public function email() {
        dd(202);
        return view("email");
    }

    // ========== [ Compose Email ] ================
    public function composeEmail(Request $request) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host       = 'smtp.titan.email'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true; // Enable SMTP authentication
            $mail->Username   = 'signature@crm-ucc.online'; // SMTP username
            $mail->Password   = '@Aa!!12@'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port       = 465; // TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

            // Recipients
            $mail->setFrom('signature@crm-ucc.online', 'DH Energie');
            $mail->addAddress('ramiaramanananaharisoa@gmail.com'); // Name is optional

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'TEST PHPMAILER';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


}

