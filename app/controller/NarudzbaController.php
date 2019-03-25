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
}