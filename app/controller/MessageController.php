<?php

class MessageController{

    function email(){

        $error = '';
        $name = '';
        $email = '';
        $message = '';

        function clean_text($string)
        {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;

        }

        if(isset($_POST["submit"])){
        if(empty($_POST["name"]))
        {
            $error .= '<p><label>Molimo unesite ime</label></p>';
        }else{
            $name = clean_text($_POST["name"]);
            if(!preg_match("/^[a-zA-Z]*$/",$name))
            {
                $error .= '<p><label>Moguće unijeti samo tekst i prazna mjesta..</label></p>';
            }
        }
        if(empty($_POST["email"]))
        {
            $error .= '<p><label>Molimo unesite vaš email..</label></p>';
        }else{
            $email = clean_text($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error .= '<p><label>Netočan email format..</label></p>';

            }
        }
        if(empty($_POST["message"]))
        {
            $error .= '<p><label>Molimo unijeti poruku..</label></p>';
        }else{
            $message = clean_text($_POST["message"]);

        }
        if ($error != '')
        {
        /* Namespace alias. */
        /* use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        */
        require 'C:xampp\htdocs\polaznik09.edunova.hr\PHPMailer-master\src\Exception.php';
        require 'C:xampp\htdocs\polaznik09.edunova.hr\PHPMailer-master\src\PHPMailer.php';
        require 'C:xampp\htdocs\polaznik09.edunova.hr\PHPMailer-master\src\SMTP.php';

        /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
        $mail = new PHPMailer(TRUE);
        /* Open the try/catch block. */
        try {
        /* Set the mail sender. */
        $mail->setFrom($_POST["email"]);
        /* Add a recipient. */
        $mail->addAddress('alosinac111@gmail.com');
        /* Set the subject. */
        $mail->Subject = 'Poruka sa stranice';
        /* Set the mail message body. */
        $mail->Body = 'Od: ' . $_POST["name"] . ', ' .  $_POST["email"] . ' ' . 'Poruka: ' . $_POST["message"];

        /* /Server settings */
        $mail->SMTPDebug = 1;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'alosinac111@gmail.com';                     // SMTP username
        $mail->Password   = '24051982Pie';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
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
            $name = '';
            $email = '';
            $message = '';
   }
}

    


