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
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Account');
            $errors += $this->checkUsernameUnicity($post->get('username'));
            if(!$errors) {
                $this->accountDAO->createAccount($post);
                $this->session->set('create_account', 'Votre compte a bien été créé, vous pouvez vous connecter');
                header('Location: ../public/index.php?route=login');
            } else {
                echo $this->twig->render('accountFormView.html', ['errors' => $errors]);
                return;
            }
        }
        echo $this->twig->render('accountFormView.html');
        return;
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
        if($post->get('submit')) {
            $login = $this->accountDAO->login($post);
            if($login['isPassCorrect']) {
                $this->session->set('log_account', 'Vous êtes bien connecté');
                $this->session->set('id_user', $login['result']['id_user']);
                $this->session->set('username', $post->get('username'));
                header('Location: ../public/index.php');

            } else {
                $error = ['connexion' => 'Erreur de connexion'];
                echo $this->twig->render('loginView.html', ['errors' => $error]);
                return;
            }
        }
        echo $this->twig->render('loginView.html');
        return;
    }

    public function logout()
    {
        $this->session->stop();
        $this->session->remove('id_user');
        $this->session->remove('username');
        $this->session->start();
        $this->session->set('logout', 'Vous avez été déconnecté');
        header('Location: ../public/index.php?route=login');
    }

    public function myAccount()
    {
        $this->checkIfLogedIn();
        $user = $this->accountDAO->getAccountById($this->idUser);
        echo $this->twig->render('myAccountView.html', ['user' => $user]);
    }

    public function editAccount(Parameter $post)
    {
        $this->checkIfLogedIn();
        $user = $this->accountDAO->getAccountById($this->idUser);
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Account');
            if(!$errors) {
                $this->accountDAO->editAccount($post, $this->idUser);
                $this->session->set('edit_account', 'Vos informations personnelles ont été modifiées');
                header('Location: ../public/index.php?route=myAccount');
            } else {
                echo $this->twig->render('accountFormView.html', [
                    'user' => $user,
                    'errors' => $errors
                ]);
            }
        } else {
            echo $this->twig->render('accountFormView.html', ['user' => $user]);
        }
    }


    public function lostPass(Parameter $post)
    {
        if($post->get('submitUsername') || $post->get('submitEdit')) {
            $user = $this->accountDAO->getAccountByUsername($post->get('username'));
            if($post->get('submitUsername')) {
                echo $this->twig->render('lostPassEditView.html', ['user' => $user]);
            } else {
                $errors = $this->checkSecretResponse($post->get('secretQuestion'), $user->getResponse());
                if(!$errors) {
                    $errors = $this->validation->validate($post, 'Account');
                    // TODO refacto errors
                    if(!$errors) {
                        $this->accountDAO->editPassword($post->get('username'), $post->get('password'));
                        $this->session->set('edit_password', 'Votre mot de passe a bien été modifié');
                        header('Location: ../public/index.php?route=login');
                    } else {
                        echo $this->twig->render('lostPassEditView.html', ['user' => $user, 'errors' => $errors]);
                    }
                } else {
                    echo $this->twig->render('lostPassEditView.html', ['user' => $user, 'errors' => $errors]);
                }
            }
        } else {
            echo $this->twig->render('lostPassUsernameView.html');
        }
    }

    private function checkSecretResponse($postResponse, $expectedResponse)
    {
        if(!$postResponse) {
            return ['secretQuestion' => '<p>Répondez à la question secrète</p>'];
        }
        if($postResponse !== $expectedResponse) {
            return ['secretQuestion' => '<p>Mauvaise réponse</p>'];
        }
    }
}