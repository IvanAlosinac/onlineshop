<?php

class AdminController
{
    function prijava()
    {
        $view = new View();
        $view->render('prijava',["poruka"=>""]);
    }

    function login()
    {

        $db=Db::getInstance();
        $izraz = $db->prepare("select id,firstname,surname,homeaddress,email,userpassword from user where email=:email");
        $izraz->execute(["email"=>Request::post("email")]);

        
         $view = new View();
         
        if($izraz->rowCount()>0){
            $red=$izraz->fetch();
            if(password_verify(Request::post("password"),$red->userpassword)){
                $user = new stdClass();                                         //radi klasu
                $user->id=$red->id;
                $user->firstname=$red->firstname;
                $user->surname=$red->surname;
                $user->homeaddress=$red->homeaddress;
                $user->email=$red->email;
                $user->firstnameSurname=$red->firstname . " " . $red->surname;

                Session::getInstance()->login($user); 
              
                if($red->id == 1){                                              //na id 1 je administrator
                    
                 $view->render('index');
            }else{
                
                $view->render(
                    'narudzba',
                    [
                       "narudzba"=>Asortiman::read()
                    ]
                );                                                               // za sve ostale korisnike
            }

            }else{
                $view->render('prijava',["poruka"=>"Kombinacija email i lozinka ne odgovara..."]);
            }
        }else{
            $view->render('prijava',["poruka"=>"Ne postojeći email..."]);
        }
   

    
        
        
    } 

    function odjava()
    {
        Session::getInstance()->odjava();
        $view = new View();
        $view->render('index',["poruka"=>""]);
    }

    

    
}