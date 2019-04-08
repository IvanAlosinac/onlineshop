<?php

class Customer{

    public static function read($stranica)
    {
        $poStranici=2;
        $db = Db::getInstance();
        $izraz = $db->prepare("select 
            a.id,
            a.companyname,
            a.firstname,
            a.surname,
            a.homeaddress,
            a.phone,
            a.email,
            count(b.id) as total from 
            user a left join orderproduct b on a.id=b.user
            group by 
            a.id,
            a.companyname,
            a.firstname,
            a.surname,
            a.homeaddress,
            a.phone,
            a.email
            order by a.companyname
            limit " . (($stranica*$poStranici) - $poStranici)  . ",$poStranici
            ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("select * from user where id=:id");
        $izraz->execute(["id"=>$id]);
        return $izraz->fetch();
    }

    public static function add()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("insert into user (companyname,firstname,surname,homeaddress,phone,email,userpassword) 
        values (:companyname,:firstname,:surname,:homeaddress,:phone,:email,:userpassword)");
        $izraz->execute(self::podaci());
    }

    public static function update($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("update user set 
        companyname=:companyname,
        firstname=:firstname,
        surname=:surname,
        homeaddress=:homeaddress,
        phone=:phone,
        email=:email,
        userpassword=:userpassword
        where id=:id");
        $podaci = self::podaci();
        $podaci["id"]=$id;
        $izraz->execute($podaci);
    }

    public static function delete($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("delete from user where id=:id");
        $podaci = [];
        $podaci["id"]=$id;
        $izraz->execute($podaci);
    }

    private static function podaci(){
        return [
            "companyname"=>Request::post("companyname"),
            "firstname"=>Request::post("firstname"),
            "surname"=>Request::post("surname"),
            "homeaddress"=>Request::post("homeaddress"),
            "phone"=>Request::post("phone"),
            "email"=>Request::post("email"),
            "userpassword"=>password_hash(Request::post("userpassword"),PASSWORD_BCRYPT)
        ];
    }

    public static function register()
    {
        /*$companyname = Request::post("companyname");
        $firstname = Request::post("firstname");
        $surname = Request::post("surname");
        $homeaddress = Request::post("homeaddress");
        $phone = Request::post("phone");
        $email = Request::post("email");
        $customerpassword = Request::post("customerpassword");

        //validacija
        if($firstname == null || $surname == null || $homeaddress == null || $phone == null || $email == null || $customerpassword == null)
        return 0;

        $customerpassword = password_hash($customerpassword); //hasing
        */
        $db=Db::getInstance();
        $izraz = $db->prepare("insert into user (companyname,firstname,surname,homeaddress,phone,email,userpassword) 
        values (:companyname,:firstname,:surname,:homeaddress,:phone,:email,:userpassword)");
        
       /*  print_r(self::podaci());exit; */
        $izraz->execute(self::podaci());

    }

    


    


}