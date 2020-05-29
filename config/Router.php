<?php

namespace App\config;

use App\src\controller\Controller;

class Router
{

    private $controller;


    public function __construct()
    {
        $this->controller = new Controller();
    }

    public function run()
    {

        try{
            if(isset($_GET['route']))
            {
                echo 'route inconnue';
            }
            else{
                $this->controller->home();
            }
        }
        catch (Exception $e)
        {
            echo 'Erreur serveur: '. $e;
        }
    }
}