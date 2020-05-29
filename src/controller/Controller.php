<?php

namespace App\src\controller;
use App\src\DAO\DAO;

class Controller
{
    private $DAO;

    public function __construct()
    {
        $this->DAO = new DAO;
    }

    public function home()
    {
        $this->DAO->checkConnection();
        header('Location:../templates/home.php');
    }
}