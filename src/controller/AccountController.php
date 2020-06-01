<?php

namespace App\src\controller;

use App\src\DAO\AccountDAO;
use App\config\Parameter;

class AccountController extends Controller
{
    protected $accountDAO;

    public function __construct()
    {
        parent::__construct();
        $this->accountDAO = new AccountDAO();
    }

    public function register(Parameter $post)
    {
        if($post->get('submit')!== null) {
            $errors = $this->validation->validate($post, 'Account');
            $errors += $this->checkUsernameUnicity($post->get('username'));
            if(!$errors) {
                $this->accountDAO->createAccount($post);
                $this->session->set('create_account', 'Votre compte a bien été créé, vous pouvez vous connecter');
                header('Location: ../public/index.php?route=login');
            } else {
                return $this->view->render('accountFormView', ['errors' => $errors]);
            }
        }
        return $this->view->render('accountFormView');
    }

    private function checkUsernameUnicity($username) {
        $usernameExists = $this->accountDAO->checkIfUsernameExists($username);
        $errors = [];
        if($usernameExists) {
            $errors = ['username' => '<p>Ce nom d\'utilisateur existe déjà<p>'];
        }
        return $errors;
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
        header('Location: ../public/index.php?route=login');
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

    public function editAccount(Parameter $post)
    {
        if($this->idUser) {
            $user = $this->accountDAO->getAccountById($this->idUser);
            if($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Account');
                if(!$errors) {
                    $this->accountDAO->editAccount($post, $this->idUser);
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


    public function lostPass(Parameter $post)
    {
        if($post->get('submitUsername') || $post->get('submitEdit')) {
            $user = $this->accountDAO->getAccountByUsername($post->get('username'));
            if($post->get('submitUsername')) {
                return $this->view->render('lostPassEditView', ['user' => $user]);
            } else {
                $errors = $this->checkSecretResponse($post->get('secretQuestion'), $user->getResponse());
                if(!$errors) {
                    $errors = $this->validation->validate($post, 'Account');
                    if(!$errors) {
                        $this->accountDAO->editPassword($post->get('username'), $post->get('password'));
                        $this->session->set('edit_password', 'Votre mot de passe a bien été modifié');
                        header('Location: ../public/index.php?route=login');
                    } else {
                        return $this->view->render('lostPassEditView', ['user' => $user, 'errors' => $errors]);
                    }
                } else {
                    return $this->view->render('lostPassEditView', ['user' => $user, 'errors' => $errors]);
                }
            }
        } else {
            return $this->view->render('lostPassUsernameView');
        }
    }

    private function checkSecretResponse($postResponse, $expectedResponse)
    {
        if(!$postResponse) {
            return ['secretQuestion' => '<p>Répondez à la question secrète</p>'];
        }
        elseif($postResponse !== $expectedResponse) {
            return ['secretQuestion' => '<p>Mauvaise réponse</p>'];
        }
    }
}