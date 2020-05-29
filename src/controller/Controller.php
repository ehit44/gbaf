<?php

namespace App\src\controller;
use App\src\DAO\DAO;
use App\src\model\View;

class Controller
{
    private $DAO;
    private $view;

    public function __construct()
    {
        $this->DAO = new DAO;
        $this->view = new View;
    }

    public function home()
    {
        $this->DAO->checkConnection();
        $this->view->render('home');
        //header('Location:../templates/home.php');
    }
}