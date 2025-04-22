<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__.'/../lib/phpmailer/vendor/autoload.php';

require __DIR__ . '/../class/class.Consulta.php';
require __DIR__.'/../class/class.Usuario.php';
require __DIR__ . '/../class/class.Mascota.php';

$consulta = new Consulta(7);
$mascota = new Mascota($consulta->getIdMascota());
$veterinario = new Usuario($consulta->getIdVeterinario());

$mensaje  = "Confirmamos su consulta con los siguientes datos: <br>";
$mensaje .= "Fecha y hora: <br>".$consulta->getFechaHora(true)."<br>";
$mensaje .= "Veterinario: <br>".$veterinario->getNombreCompleto()."<br>";
$mensaje .= "<br><br>";
$mensaje .= "En caso de que no pueda acudir, por favor llame al 922 25 25 25";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'tomas.baez91@gmail.com';                     //SMTP username
    $mail->Password   = 'zvojedilrzfvfvla';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tomas.baez91@gmail.com', 'Tomas Baez');
    $mail->addAddress('tomas.baez91@gmail.com', 'Tomas Baez');     //Add a recipient
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Confirmación de consulta';
    $mail->Body    = $mensaje;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
