<?php

namespace App\src\controller;

use App\src\DAO\AccountDAO;
use App\src\model\View;
use App\config\Request;
use App\config\Parameter;

class Controller
{
    private $accountDAO;
    private $view;

    private $request;
    private $get;
    private $post;
    private $session;

    public function __construct()
    {
        $this->accountDAO = new AccountDAO;
        $this->view = new View;

        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
    }

    public function home()
    {
        $this->view->render('homeView');
    }

    public function register(Parameter $post)
    {
        if($post->get('submit')!== null) {
            $this->accountDAO->createAccount($post);
            $this->session->set('create_account', 'Votre compte a bien été créé');
            header('Location: ../public/index.php');
        }
        $this->view->render('registerView');
    }

    public function login(Parameter $post)
    {
        if($post->get('submit')!== null) {
            $login = $this->accountDAO->login($post);
            if($login['isPassCorrect']) {
                var_dump($login);
                $this->session->set('log_account', 'Vous êtes bien connecté');
                $this->session->set('id_user', $login['result']['id_user']);
                $this->session->set('username', $post->get('username'));
                header('Location: ../public/index.php');

            } else {
                echo 'erreur de connexion';
            }
        }
        $this->view->render('loginView');
    }
}