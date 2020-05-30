<?php

namespace App\config;

use App\src\controller\Controller;
use App\config\Request;

class Router
{

    private $controller;
    private $request;


    public function __construct()
    {
        $this->controller = new Controller();
        $this->request = new Request();
    }

    public function run()
    {
        $post = $this->request->getPost();
        $post = $this->request->getPost();
        $route = $this->request->getGet()->get('route');
        var_dump($post);
        var_dump($this->request->getSession());
        try{
            if($this->request->getSession())
            if(isset($route))
            {
                if($route === 'register') {
                    $this->controller->register($post);
                }
                elseif($route === 'login') {
                    $this->controller->login($post);
                }
                elseif($route === 'logout') {
                    $this->controller->logout();
                }
                elseif($route === 'myAccount') {
                    $this->controller->myAccount();
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