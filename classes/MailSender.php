<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require "Exception.php";
    require "PHPMailer.php";
    require "SMTP.php";

    class MailSender {
        function __construct() {
            include_once "Config.php";

            $this->Host = $Host;
            $this->Port = $Port;
            $this->SMTPSecure = $SMTPSecure;
            $this->Username = $Username;
            $this->Password = $Password;
            $this->CharSet = $CharSet;
            $this->From = $From;
            $this->FromName = $FromName;
        }

        function SendMail($address, $subject, $body, $isHtml = false) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();                      // SMTP-n keresztüli küldés  
                $mail->Host = $this->Host;            // SMTP szerverek
                $mail->Port = $this->Port;
                $mail->SMTPSecure = $this->SMTPSecure;// Kódolás
                $mail->SMTPAuth = true;               // SMTP autentikáció bekapcs  
                $mail->Username = $this->Username;    // SMTP felhasználó  
                $mail->Password = $this->Password;    // SMTP jelszó  
                $mail->CharSet = $this->CharSet;             // Karakterkódolás
    
                $mail->setFrom($this->From, $this->FromName);
                $mail->addAddress($address);                   // Címzett beállítása
    
                $mail->isHTML($isHtml);                        // Küldés HTML-ként  
    
                $mail->Subject = $subject;                     // A levél tárgya  
                $mail->Body = $body;                           // A levél tartalma
                $mail->AltBody = strip_tags($body);            // A levél tartalma HTML-t nem támogató klienseknek
    
                //echo var_dump($mail);
    
                $mail->send();

                return "Sent";
            }
            catch (Exception $e) {
                return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>