<?php

namespace App\src\controller;
use App\src\DAO\ActorDAO;
use App\src\DAO\OpinionDAO;
use App\config\Parameter;

class DisplayController extends Controller
{
    protected $actorDAO;
    protected $opinionDAO;

    public function __construct()
    {
        parent::__construct();
        $this->actorDAO = new ActorDAO();
        $this->opinionDAO = new OpinionDAO();
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
        $actor = $this->actorDAO->getActorById($actorId);
        if($post->get('submit'))
        {
            $this->opinionDAO->postOpinion($post, $actorId, $this->session->get('id_user'));
            $this->session->set('post_opinion', 'Votre avis a bien été posté');
        }
        return $this->view->render('actorView', ['actor' => $actor]);
    }
}