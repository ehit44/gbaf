<?php

namespace App\src\controller;

use App\src\DAO\AccountDAO;
use App\src\model\View;
use App\config\Request;
use App\config\Parameter;
use App\src\constraint\Validation;

class Controller
{
    private $accountDAO;
    private $view;

    private $request;
    private $get;
    private $post;
    private $session;
    private $validation;

    private $idUser;

    public function __construct()
    {
        $this->accountDAO = new AccountDAO();
        $this->view = new View();

        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        $this->validation = new Validation();

        $this->idUser = $this->session->get('id_user');
    }

    public function home()
    {
        if($this->idUser) {
            return $this->view->render('homeView');
        } else {
            $this->session->set('need_login', 'vous devez vous connecter pour accéder à cette page');
            return $this->view->render('loginView');
        }
    }

    public function register(Parameter $post)
    {
        if($post->get('submit')!== null) {
            $errors = $this->validation->validate($post, 'Account');
            if(!$errors) {
                $this->accountDAO->createAccount($post);
                $this->session->set('create_account', 'Votre compte a bien été créé');
                header('Location: ../public/index.php');
            } else {
                return $this->view->render('accountFormView', ['errors' => $errors]);
            }
        }
        return $this->view->render('accountFormView');
    }

    public function login(Parameter $post)
    {
        if($post->get('submit')!== null) {
            $login = $this->accountDAO->login($post);
            if($login['isPassCorrect']) {
                $this->session->set('log_account', 'Vous êtes bien connecté');
                $this->session->set('id_user', $login['result']['id_user']);
                $this->session->set('username', $post->get('username'));
                header('Location: ../public/index.php');

            } else {
                echo 'erreur de connexion';
            }
        }
        return $this->view->render('loginView');
    }

    public function logout()
    {
        $this->session->stop();
        $this->session->set('id_user', '');
        $this->session->set('username', '');
        $this->session->start();
        $this->session->set('logout', 'Vous avez été déconnecté');
        header('Location: ../public/index.php');
    }

    public function myAccount()
    {
        if($this->idUser) {
            $user = $this->accountDAO->getAccountById($this->idUser);
            return $this->view->render('myAccountView', ['user' => $user]);
        } else {
            $this->session->set('need_login', 'vous devez vous connecter pour accéder à cette page');
            return $this->view->render('loginView');
        }
    }

    public function editAccount()
    {
        if($this->idUser) {
            $user = $this->accountDAO->getAccountById($this->idUser);
            if($this->post->get('submit')) {
                $errors = $this->validation->validate($this->post, 'Account');
                if(!$errors) {
                    $this->accountDAO->editAccount($this->post, $this->idUser);
                    $this->session->set('edit_account', 'Vos informations personnelles ont été modifiées');
                    header('Location: ../public/index.php?route=myAccount');
                } else {
                    return $this->view->render('accountFormView', [
                        'user' => $user, 'errors' => $errors
                        ]);
                }
            } else {
                return $this->view->render('accountFormView', ['user' => $user]);
            }
        } else {
            $this->session->set('need_login', 'vous devez vous connecter pour accéder à cette page');
            return $this->view->render('loginView');
        }
    }
}