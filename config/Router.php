<?php

namespace App\config;

use App\src\controller\Controller;
use App\config\Request;

class Router
{

    private $controller;
    private $request;
    private $post;


    public function __construct()
    {
        $this->controller = new Controller();
        $this->request = new Request();
    }

    public function run()
    {
        $post = $this->request->getPost();
        $route = $this->request->getGet()->get('route');
        var_dump($_POST);
        try{
            if(isset($route))
            {
                if($route === 'register') {
                    $this->controller->register($post);
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