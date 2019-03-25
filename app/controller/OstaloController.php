<?php

class OstaloController{

    function index(){
        $view = new View();
    
        $view->render(
            'ostalo',
            [
               "ostalo"=>Asortiman::read()
            ]
        );
    }
}