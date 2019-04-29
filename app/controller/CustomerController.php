<?php

class CustomerController extends ProtectedController
{
    
    function index($stranica=1){
        if($stranica<=0){
            $stranica=1;
        }
        if($stranica===1){
            $prethodna=1;
        }else{
            $prethodna=$stranica-1;
        }
        $sljedeca=$stranica+1;
        
        $view = new View();
        $view->render(
            'customers/index',
            [
            "customers"=>Customer::read($stranica),
             "prethodna"=>$prethodna,
             "sljedeca"=>$sljedeca 
            ]
        );
        
    }

    function add()
    {
        
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Customer::add();
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'customers/new',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    function customerlogin()
    {
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Customer::add();
           
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

    function edit($id)
    {
        $_POST["id"]=$id;
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Customer::update($id);
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'customers/edit',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    function delete($id)
    {
            Customer::delete($id);
            $this->index();
    }

    function kontrola()
    {
        if(Request::post("firstname")===""){
            return "Ime obavezno";
        }

        if(strlen(Request::post("surname"))>50){
            return "Prezime ne smije biti veći od 50 znakova";
        }

        /* $db = Db::getInstance();   ***vraća istu poruku i ako nema tvrtke***
        $izraz = $db->prepare("select count(id) from user where companyname=:companyname and id<>:id");
        $izraz->execute(["companyname"=>Request::post("companyname"), "id" => Request::post("id")]);
        $ukupno = $izraz->fetchColumn();
        if($ukupno>0){
            return "Naziv postoji, odaberite drugi";
        } */ 
        

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

        /* if(intval(Request::post("priceperpiece")) <= 0){
            return "Cijena ne može biti nula ili minus!";
        }

        if(intval(Request::post("stock")) < 0){
            return "Zaliha ne može biti u minusu!";
        }

        if(intval(Request::post("category")) != 1 && intval(Request::post("category")) != 2)  {
            return "Dodaj kategoriju. Kategorija moze biti samo: 1-(Bozuri) ili 2-(Ostalo)";
        }
 */
        return true;
    }

    function prepareadd()
    {
        $view = new View();
        $view->render(
            'customers/new',
            [
            "poruka"=>""
            ]
        );
    }

    

    function prepareedit($id)
    {
        $view = new View();
        $smjer = Customer::find($id);
        $_POST["companyname"]=$smjer->companyname;
        $_POST["firstname"]=$smjer->firstname;
        $_POST["surname"]=$smjer->surname;
        $_POST["homeaddress"]=$smjer->homeaddress;
        $_POST["phone"]=$smjer->phone;
        $_POST["email"]=$smjer->email;
        $_POST["userpassword"]=$smjer->userpassword;
        $_POST["id"]=$smjer->id;

        $view->render(
            'customers/edit',
            [
            "poruka"=>""
            ]
        );
    }

    /* login za customers kada se registriraju, mozda moze bolje rjesenje,
    (kopirano sa admin/login) */
    
    function log()   
    {

        $db=Db::getInstance();
        $izraz = $db->prepare("select id,firstname,surname,homeaddress,email,userpassword from user where email=:email");
        $izraz->execute(["email"=>Request::post("email")]);

        
         $view = new View();
         
        if($izraz->rowCount()>0){
            $red=$izraz->fetch();
            if(password_verify(Request::post("userpassword"),$red->userpassword)){
                $user = new stdClass();                                         //radi klasu
                $user->id=$red->id;
                $user->firstname=$red->firstname;
                $user->surname=$red->surname;
                $user->homeaddress=$red->homeaddress;
                $user->email=$red->email;
                $user->firstnameSurname=$red->firstname . " " . $red->surname;

                Session::getInstance()->login($user); 
              
            
                
                $view->render('narudzba');                                      // za sve ostale korisnike
            }else{
                $view->render('prijava',["poruka"=>"Kombinacija email i lozinka ne odgovara..."]);
            }
        }else{
            $view->render('prijava',["poruka"=>"Ne postojeći email..."]);
        }      
        
    } 

} 