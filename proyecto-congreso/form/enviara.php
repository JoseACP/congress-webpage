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
    $articulo = $_POST['articulo'];
    $n_a1 = $_POST['n_a1'];
    $ocupacion = $_POST['ocupacion'];
    $n_a2 = $_POST['n_a2'];
    $n_a3 = $_POST['n_a3'];
    $email = $_POST['email'];
    $institucion = $_POST['institucion'];
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
    $mail->setFrom('congreso.manufactura@unipolidgo.edu.mx', 'Congreso_Articulos');
    $mail->addAddress('congreso.articulos@unipolidgo.edu.mx');     //Add a recipient campiar por correo de articulos
    
               //Name is optional

    //Attachments
   
    //Content
    $mail->WordWrap = 50; 
    $mail->IsHTML(true);     
    $mail->Subject  =  "Congreso internacional de Ingenieria en Manufactura";
    $mail->Body     =  "\n<br /> Nombre del articulo: $articulo \n<br />".    
    "Nombre del autor principal: $n_a1 \n<br />".    
    "Ocupación: $ocupacion \n<br />".
    "Nombre del segundo autor: $n_a2 \n<br />".
    "Nombre del tercer autor: $n_a3 \n<br />".
    "Email principal: $email \n<br />".
    "Institución: $institucion \n<br />".
    "País: $pais \n<br />";
     $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);

    $mail->send();   
    echo "<script language='javascript'> alert('Message has been sent')</script>";
} catch (Exception $e) {
    echo "<script language='javascript'> alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
}

?>

</body>
</html>




