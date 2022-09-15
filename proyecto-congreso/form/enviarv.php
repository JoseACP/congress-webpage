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

if(isset($_POST['enviar'])){
    $equipo= $_POST['equipo'];
    $n_p1 = $_POST['n_p1'];
    $n_p2 = $_POST['n_p2'];
    $n_p3 = $_POST['n_p3'];
    $email = $_POST['email'];
    $asesor= $_POST['asesor'];
    $pais = $_POST['pais'];
    $archivo = $_FILES['adjunto'];
}
require 'php/Exception.php';
require 'php/PHPMailer.php';
require 'php/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
    $mail->setFrom('congreso.manufactura@unipolidgo.edu.mx', 'Congreso_Vehiculos');
    $mail->addAddress('congreso.vehiculos@unipolidgo.edu.mx');     //Add a recipient campiar por correo de articulos
    
               //Name is optional

    //Attachments
   
    //Content
    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Congreso internacional de ingenieria en manufactura 2022";
    $mail->Body     =  "<br /> Nombre del equipo: $equipo \n<br />".   
    "\n<br /> Nombre de los participantes:  \n<br /> $n_p1 \n<br /> $n_p2 \n<br /> $n_p3 \n<br />".    
    "\n<br /> Email principal: $email \n<br />".    
    "\n<br /> Asesor: $asesor\n<br />".
    "\n<br /> Pais: $pais \n<br />";
     $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);

     $mail->send();   
     echo "<script language='javascript'> alert('Message has been sent')</script>";
 } catch (Exception $e) {
    echo "<script language='javascript'> alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
 }
 
 ?>
</body>
</html>