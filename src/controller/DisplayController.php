<?php

namespace App\src\controller;
use App\src\DAO\ActorDAO;

class DisplayController extends Controller
{
    protected $actorDAO;

    public function __construct()
    {
        parent::__construct();
        $this->actorDAO = new ActorDAO();
    }
    
    public function home()
    {
        if($this->idUser) {
            $actors = $this->actorDAO->getAllActors();
            return $this->view->render('homeView', ['actors' => $actors]);
        } else {
            $this->session->set('need_login', 'vous devez vous connecter pour accéder à cette page');
            return $this->view->render('loginView');
        }
    }
}