<?php

class ProductController extends ProtectedController
{
    function add()
    {
        
        $kontrola = $this->kontrola();
        if($kontrola===true){
            Product::add();
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'products/new',
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
            Product::update($id);
            $this->index();
        }else{
            $view = new View();
            $view->render(
                'products/edit',
                [
                "poruka"=>$kontrola
                ]
            );
        }

    }

    function delete($id)
    {
            Product::delete($id);
            $this->index();
    }

    function kontrola()
    {
        if(Request::post("productname")===""){
            return "Naziv obavezno";
        }

        if(strlen(Request::post("productname"))>50){
            return "Naziv ne smije biti veći od 50 znakova";
        }

        $db = Db::getInstance();
        $izraz = $db->prepare("select count(id) from product where productname=:productname and id<>:id");
        $izraz->execute(["productname"=>Request::post("productname"), "id" => Request::post("id")]);
        $ukupno = $izraz->fetchColumn();
        if($ukupno>0){
            return "Naziv postoji, odaberite drugi";
        }
        

        if(Request::post("priceperpiece")===""){
            return "Cijena obavezno";
        }

        if(intval(Request::post("priceperpiece")) <= 0){
            return "Cijena ne može biti nula ili minus!";
        }

        if(intval(Request::post("stock")) < 0){
            return "Zaliha ne može biti u minusu!";
        }

        if(intval(Request::post("category")) != 1 && intval(Request::post("category")) != 2)  {
            return "Dodaj kategoriju. Kategorija moze biti samo: 1-(Bozuri) ili 2-(Ostalo)";
        }

        return true;
    }

    function prepareadd()
    {
        $view = new View();
        $view->render(
            'products/new',
            [
            "poruka"=>""
            ]
        );
    }

    function prepareedit($id)
    {
        $view = new View();
        $smjer = Product::find($id);
        $_POST["productname"]=$smjer->productname;
        $_POST["productdescription"]=$smjer->productdescription;
        $_POST["priceperpiece"]=$smjer->priceperpiece;
        $_POST["stock"]=$smjer->stock;
        $_POST["category"]=$smjer->category;
        $_POST["id"]=$smjer->id;

        $view->render(
            'products/edit',
            [
            "poruka"=>""
            ]
        );
    }


    function index(){
        $view = new View();
        $view->render(
            'products/index',
            [
            "products"=>Product::read()
            ]
        );
    }
}