<?php

if(isset($_POST['register'])){
    $Nombre = $_POST['nombre'];
    $Email = $_POST['email'];
    $Pais = $_POST['pais'];
    $Puesto = $_POST['puesto'];
    $archivo = $_FILES['adjunto'];
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/Exception.php';
require 'php/PHPMailer.php';
require 'php/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jose.chairez.is@unipolidgo.edu.mx';                     //SMTP username
    $mail->Password   = 'HERMILA2001';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('jose.chairez.is@unipolidgo.edu.mx', 'Jose');
    $mail->addAddress($Email);     //Add a recipient
    $mail->addAddress('chairezpantojaj@gmail.com');               //Name is optional

    //Attachments
   
    //Content
    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Congreso internacional de Infenieria en Manufactura";
    $mail->Body     =  "\n<br /> Nombre: $Nombre \n<br />".    
    "Email: $Email \n<br />".    
    "Pais: $Pais \n<br />".
    "Puesto: $Puesto \n<br />";
     $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}