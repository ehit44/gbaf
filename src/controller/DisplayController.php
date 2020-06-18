<?php

namespace App\src\controller;
use App\src\DAO\ActorDAO;
use App\config\Parameter;

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
        echo $this->twig->render('homeView.html', ['actors' => $actors]);

    }
    public function getActorPage($actorId)
    {
        $this->checkIfLogedIn();
        $actor = $this->actorDAO->getActorById($actorId);
        $opinions = $this->opinionDAO->getOpinionsPerActorId($actorId);
        $vote = $this->voteDAO->buildObject($actorId, $this->idUser);
        echo $this->twig->render(
            'actorView.html', ['actor' => $actor, 'opinions' => $opinions, 'vote' => $vote]
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
                $this->session->set('error_post', $errors['opinion']);
            }
        }
        $this->getActorPage($actorId);
    }

    public function upVote($actorId)
    {
        $this->checkIfLogedIn();
        $voteStatus = $this->voteDAO->getVoteStatus($actorId, $this->idUser);
        if($voteStatus === '1') {
            $this->voteDAO->deleteVote($actorId, $this->idUser);
        } elseif($voteStatus === '0') {
            $this->voteDAO->updateVote($actorId, $this->idUser, 1);
        } elseif($voteStatus === null) {
            $this->voteDAO->addVote($actorId, $this->idUser, 1);
        }
        header('Location: ../public/index.php?route=getActor&actorId=' .$actorId);
    }

    public function downVote($actorId)
    {
        $this->checkIfLogedIn();
        $voteStatus = $this->voteDAO->getVoteStatus($actorId, $this->idUser);
        if($voteStatus === '0') {
            $this->voteDAO->deleteVote($actorId, $this->idUser);
        } elseif($voteStatus === '1') {
            $this->voteDAO->updateVote($actorId, $this->idUser, 0);
        } elseif($voteStatus === null) {
            $this->voteDAO->addVote($actorId, $this->idUser, 0);
        }
        header('Location: ../public/index.php?route=getActor&actorId=' .$actorId);
    }

}