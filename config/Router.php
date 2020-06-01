<?php

namespace App\config;

use App\src\controller\AccountController;
use App\src\controller\DisplayController;
use App\config\Request;

class Router
{

    private $accountController;
    private $displayController;
    private $request;


    public function __construct()
    {
        $this->accountController = new AccountController();
        $this->displayController = new DisplayController();
        $this->request = new Request();
    }

    public function run()
    {
        $post = $this->request->getPost();
        $get = $this->request->getGet();
        $route = $this->request->getGet()->get('route');
        var_dump($post);
       // var_dump($this);
        try{
            if($this->request->getSession())
            if(isset($route))
            {
                if($route === 'register') {
                    $this->accountController->register($post);
                }
                elseif($route === 'login') {
                    $this->accountController->login($post);
                }
                elseif($route === 'logout') {
                    $this->accountController->logout();
                }
                elseif($route === 'myAccount') {
                    $this->accountController->myAccount();
                }
                elseif($route === 'editAccount') {
                    $this->accountController->editAccount($post);
                }
                elseif($route === 'lostPass') {
                    $this->accountController->lostPass($post);
                }
                elseif($route === 'getActor') {
                    $this->displayController->getActor($get->get('actorId'));
                }
                else {
                echo 'route inconnue';
                }
            }
            else{
                $this->displayController->home();
            }
        }
        catch (Exception $e)
        {
            echo 'Erreur serveur: '. $e;
        }
    }
}