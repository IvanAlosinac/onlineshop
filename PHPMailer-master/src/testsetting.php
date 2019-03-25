<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:xampp\htdocs\ONLINESHOP\PHPMailer-master\src\Exception.php';
require 'C:xampp\htdocs\ONLINESHOP\PHPMailer-master\src\PHPMailer.php';
require 'C:xampp\htdocs\ONLINESHOP\PHPMailer-master\src\SMTP.php';
/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);
/* Open the try/catch block. */
try {
   /* Set the mail sender. */
   $mail->setFrom('alosinac111@gmail.com', 'Ivan');
   /* Add a recipient. */
   $mail->addAddress('alosinac111@gmail.com', 'Ivan');
   /* Set the subject. */
   $mail->Subject = 'Force';
   /* Set the mail message body. */
   $mail->Body = 'There is a great disturbance in the Force.';

   /* /Server settings */
    $mail->SMTPDebug = 1;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'alosinac111@gmail.com';                     // SMTP username
    $mail->Password   = '24051982Pie';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    
   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}
