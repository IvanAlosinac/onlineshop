<?php

class RegisterController 
{


    function registerlogin()
    {
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Customer::add();
           /*  Session::getInstance()->login($user); */
            
            /* $view = new View();
            $view->render(
                'narudzba'
            ); */
            $this->log();
        }else{
            $view = new View();
            $view->render(
                'customers/register',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    function signup()
    {
        $view = new View();
        $view->render(
            'customers/register'
        );
    }

    /* login za customers kada se registriraju, mozda moze bolje rjesenje,
    (kopirano sa admin/login) */
    
    function log()   
    {

        $db=Db::getInstance();
        $izraz = $db->prepare("select id,firstname,surname,email,userpassword from user where email=:email");
        $izraz->execute(["email"=>Request::post("email")]);

        
         $view = new View();
         
        if($izraz->rowCount()>0){
            $red=$izraz->fetch();
            if(password_verify(Request::post("userpassword"),$red->userpassword)){
                $user = new stdClass();                                         //radi klasu
                $user->id=$red->id;
                $user->firstname=$red->firstname;
                $user->surname=$red->surname;
                $user->email=$red->email;
                $user->firstnameSurname=$red->firstname . " " . $red->surname;

                Session::getInstance()->login($user); 
              
            
                
                $view->render(
                    'narudzba',
                    [
                       "narudzba"=>Asortiman::read()
                    ]
                );                                         // za sve ostale korisnike
            }else{
                $view->render('prijava',["poruka"=>"Kombinacija email i lozinka ne odgovara..."]);
            }
        }else{
            $view->render('prijava',["poruka"=>"Ne postojeći email..."]);
        }
   

    
        
        
    } 
    function kontrola()
    {
        if(Request::post("firstname")===""){
            return "Ime obavezno";
        }

        if(strlen(Request::post("surname"))>50){
            return "Prezime ne smije biti veći od 50 znakova";
        }

        if(Request::post("surname")===""){
            return "Prezime obavezno";
        }

        if(Request::post("phone")===""){
            return "Broj telefona obavezno";
        }

        if(Request::post("email")===""){
            return "Email obavezno";
        }

        if(Request::post("userpassword")===""){
            return "Lozinka obavezno";
        }

        
        return true;
    }

    


} 