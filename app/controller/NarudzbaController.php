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
}