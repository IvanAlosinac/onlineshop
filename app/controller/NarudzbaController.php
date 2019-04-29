<?php

class NarudzbaController{
    
    function index(){
        $view = new View();
    
        $view->render(
            'narudzba',
            [
               "narudzba"=>Asortiman::read()
            ]
        );
    }

    function izracun(){

        
        $view = new View();
        $view->render(
            'izvrsenanarudzba',
            [
                "narudzba"=>Asortiman::read()
             ]
        );
        
    }

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
        $body ="Upravo naručeno:" . "<br />" . "Coral Charm: " .
         $_POST["b1"] . "<br />" . "Karl Rosenfield: " . 
         $_POST["b2"] . "<br />" . "Sarah Bernhard: " . 
         $_POST["b3"] . "<br />" . "Duchesse De Nemours: " . 
         $_POST["b4"] . "<br />" . "Ranunculus: " . 
         $_POST["b5"]. "<br />" . "Naručio: " . Session::getInstance()->getUser()->firstnameSurname . 
         "<br />" . Session::getInstance()->getUser()->homeaddress;
        
         
        $message = (new Swift_Message('Nova narudžba!!'))
          ->setFrom(['alosinac111@gmail.com' => 'Ivan'])
          ->setTo(['alosinac111@gmail.com'])
          /* ->setCc([''])
          ->setBcc(['']) */
          ->setBody($body)
          ->setContentType('text/html')
        ;
    
        // Send the message
        $mailer->send($message);
        $view = new View();
        $view->render('index');
        
        }
}