<?php

class MessageController{

    function email(){

        
    //https://artisansweb.net/send-email-using-gmail-smtp-server-swift-mailer-library/
    
    /* require_once 'vendor/autoload.php'; */
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
      ->setUsername('alosinac111@gmail.com')
      ->setPassword('24051982Pie')
    ;
     
    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
     
    // Create a message
    $body = $_POST["message"];
     
    $message = (new Swift_Message('Sa internet stranice OPG-a'))
      ->setFrom([$_POST["email"] => $_POST["email"] . " " . "Od: " .  $_POST["name"]])
      ->setTo(['alosinac111@gmail.com'])
      /* ->setCc([''])
      ->setBcc(['']) */
      ->setBody($body)
      ->setContentType('text/html')
    ;

    // Send the message
    $mailer->send($message);
    $view = new View();
    $view->render('kontakt');
    
    }
    
}

    


