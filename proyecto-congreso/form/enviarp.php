<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0; url=../index.php">
    <title>Document</title>
</head>
<body>
<?php

if(isset($_POST['register'])){
    $Nombre = $_POST['n_p1'];
    $Nombre1 = $_POST['n_p2'];
    $Nombre2 = $_POST['n_p3'];
    $Email = $_POST['email'];
    $Pais = $_POST['pais'];
    $Asesor = $_POST['n_asesor'];
    $Escuela = $_POST['institucion'];
    $Prototipo = $_POST['prototipo'];
    $Categoria = $_POST['categoria'];
    $Modalidad = $_POST['modalidad'];
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
    $mail->Username   = 'congreso.manufactura@unipolidgo.edu.mx';                     //SMTP username
    $mail->Password   = 'congreso2022$';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('congreso.manufactura@unipolidgo.edu.mx', 'Congreso_Prototipos');
    $mail->addAddress('congreso.prototipos@unipolidgo.edu.mx');     //Add a recipient campiar por correo de articulos
    
               //Name is optional

    //Attachments
   
    //Content
    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Congreso internacional de ingenieria en manufactura 2022";
    $mail->Body     =  "\n<br /> Nombre de los participantes:  \n<br /> $Nombre \n<br /> $Nombre1 \n<br /> $Nombre2 \n<br />".    
    "\n<br /> Email principal: $Email \n<br />".    
    "\n<br /> Pais: $Pais \n<br />". 
    "\n<br /> Asesor: $Asesor\n<br />".
    "\n<br /> Institución: $Escuela \n<br />".
    "\n<br /> Prototipo: $Prototipo \n<br />".
    "\n<br /> Categoria: $Categoria \n<br />".
    "\n<br /> Institución: $Modalidad \n<br />";
     $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);

     $mail->send();   
     echo "<script language='javascript'> alert('Message has been sent')</script>";
 } catch (Exception $e) {
    echo "<script language='javascript'> alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
 }
 
 ?>

</body>
</html>
