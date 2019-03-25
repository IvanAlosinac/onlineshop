<?php

class Product
{

    public static function read()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("select * from product group by productname");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("select * from product where id=:id");
        $izraz->execute(["id"=>$id]);
        return $izraz->fetch();
    }

    public static function add()
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("insert into product (productname,productdescription,priceperpiece,stock,category) 
        values (:productname,:productdescription,:priceperpiece,:stock,:category)");
        $izraz->execute(self::podaci());
    }

    public static function update($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("update product set 
        productname=:productname,
        productdescription=:productdescription,
        priceperpiece=:priceperpiece,
        stock=:stock,
        category=:category
        where id=:id");
        $podaci = self::podaci();
        $podaci["id"]=$id;
        $izraz->execute($podaci);
    }

    public static function delete($id)
    {
        $db = Db::getInstance();
        $izraz = $db->prepare("delete from product where id=:id");
        $podaci = [];
        $podaci["id"]=$id;
        $izraz->execute($podaci);
    }

    private static function podaci(){
        return [
            "productname"=>Request::post("productname"),
            "productdescription"=>Request::post("productdescription"),
            "priceperpiece"=>Request::post("priceperpiece"),
            "stock"=>Request::post("stock"),
            "category"=>Request::post("category")
        ];
    }


}