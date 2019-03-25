<?php

class MessageController{

    function email(){
        /* Namespace alias. */
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'C:xampp\htdocs\polaznik09.edunova.hr\PHPMailer-master\src\Exception.php';
        require 'C:xampp\htdocs\polaznik09.edunova.hr\PHPMailer-master\src\PHPMailer.php';
        require 'C:xampp\htdocs\polaznik09.edunova.hr\PHPMailer-master\src\SMTP.php';
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
        /* Set the mail sender. */
        /* $mail->setFrom($_POST['Name'], $_POST['Email']); */
        /* Add a recipient. */
        /* $mail->addAddress('alosinac111@gmail.com', 'Ivan'); */
        /* Set the subject. */
        /* $mail->Subject = 'Poruka sa neta'; */
        /* Set the mail message body. */
        /* $mail->Body = $_POST['Message']; */

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
            /* if(isset($_POST['submit'])){
                $mail->send();
                $view = new View();
                $view->render(
                    'contact-us-thank-you'
                );
                /* header('location: contact-us-thank-you.phtml'); */
            }else{
                $view = new View();
                $view->render(
                    'kontakt'
                );
                /* header('location: kontakt.phtml'); */
                exit;
            } */
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


    }


}