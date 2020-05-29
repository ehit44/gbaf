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
        var_dump($_POST);
        try{
            if(isset($_GET['route']))
            {
                if($_GET['route'] === 'register') {
                    $this->controller->register($_POST);
                }
                else {
                echo 'route inconnue';
                }
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