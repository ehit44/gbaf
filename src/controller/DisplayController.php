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
        $this->checkIfLogedIn();
        $actors = $this->actorDAO->getAllActors();
        return $this->view->render('homeView', ['actors' => $actors]);
    }
    
    public function getActor($actorId)
    {
        $this->checkIfLogedIn();
        $actor = $this->actorDAO->getActorById($actorId);
        return $this->view->render('actorView', ['actor' => $actor]);
    }

    public function postOpinion(Parameter $post, $actorId)
    {
        $this->checkIfLogedIn();

    }
}