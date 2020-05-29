<?php

namespace App\src\controller;

use App\src\DAO\AccountDAO;
use App\src\model\View;

class Controller
{
    private $accountDAO;
    private $view;

    public function __construct()
    {
        $this->accountDAO = new AccountDAO;
        $this->view = new View;
    }

    public function home()
    {
        $this->view->render('homeView');
    }

    public function register($post)
    {
        if(isset($_POST['submit'])) {
            $this->accountDAO->createAccount($post);
            header('Location: ../public/index.php');
        }
        $this->view->render('registerView');
    }
}