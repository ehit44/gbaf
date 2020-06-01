<?php

namespace App\src\controller;

class DisplayController extends Controller
{
    public function home()
    {
        if($this->idUser) {
            return $this->view->render('homeView');
        } else {
            $this->session->set('need_login', 'vous devez vous connecter pour accéder à cette page');
            return $this->view->render('loginView');
        }
    }
}