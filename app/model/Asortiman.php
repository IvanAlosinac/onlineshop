<?php

class Asortiman{

    public static function read(){
        $db = Db::getInstance();
        $izraz = $db->prepare("select productname,productdescription,category,productimage from product");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    


}