<?php

namespace App\src\controller;
use App\src\DAO\ActorDAO;
use App\src\DAO\VoteDAO;
use App\src\DAO\OpinionDAO;
use App\config\Parameter;

class DisplayController extends Controller
{
    protected $actorDAO;
    protected $voteDAO;
    protected $opinionDAO;

    public function __construct()
    {
        parent::__construct();
        $this->actorDAO = new ActorDAO();
        $this->voteDAO = new VoteDAO();
        $this->opinionDAO = new OpinionDAO();
    }
    
    public function home()
    {
        $this->checkIfLogedIn();
        $actors = $this->actorDAO->getAllActors();
        return $this->view->render('homeView', ['actors' => $actors]);
    }
    
    public function getActorPage($actorId)
    {
        $this->checkIfLogedIn();
        $actor = $this->actorDAO->getActorById($actorId);
        $opinions = $this->opinionDAO->getOpinionsPerActorId($actorId);
        return $this->view->render(
            'actorView', ['actor' => $actor, 'opinions' => $opinions]
        );
    }

    public function postOpinion(Parameter $post, $actorId)
    {
        $this->checkIfLogedIn();
        if($post->get('submit'))
        {
            $errors = $this->validation->validate($post, 'Opinion');
            if(!$errors){
                $this->opinionDAO->postOpinion($post, $actorId, $this->session->get('id_user'));
                $this->session->set('post_opinion', 'Votre avis a bien été posté');
            } else {
                $actor = $this->actorDAO->getActorById($actorId);
                $opinions = $this->opinionDAO->getOpinionsPerActorId($actorId);
                return $this->view->render(
                    'actorView', ['actor' => $actor, 'opinions' => $opinions, 'errors' => $errors]
                );
            }
        }
        $actor = $this->actorDAO->getActorById($actorId);
        $opinions = $this->opinionDAO->getOpinionsPerActorId($actorId);
        return $this->view->render(
            'actorView', ['actor' => $actor, 'opinions' => $opinions]
        );
    }

    public function upVote($actorId)
    {
        $this->checkIfLogedIn();
        $voteStatus = $this->voteDAO->getVoteStatus($actorId, $this->idUser);
        var_dump($voteStatus);
        if($voteStatus === '1') {
            $this->voteDAO->deleteVote($actorId, $this->idUser);
            var_dump('vote supprimé');
        } elseif($voteStatus === '0') {
            $this->voteDAO->updateVote($actorId, $this->idUser, 1);
            var_dump('vote mis à jour');
        } elseif($voteStatus === null) {
            $this->voteDAO->addVote($actorId, $this->idUser, 1);
            var_dump('vote ajouté');
        }
    }
}