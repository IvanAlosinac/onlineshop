<?php

class BozuriController{

    function index(){
        $view = new View();
        $view->render(
            'bozuri',
            [
               "bozuri"=>Asortiman::read()
            ]
        );
    }
}