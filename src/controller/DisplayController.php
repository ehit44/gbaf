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
        //echo $this->twig->render('index.twig.html', ['name' => 'Fabien']);
        $this->checkIfLogedIn();
        $actors = $this->actorDAO->getAllActors();
        echo $this->twig->render('homeView.html', ['actors' => $actors, 'name' => 'Fabien']);

    }
    public function getActorPage($actorId)
    {
        $this->checkIfLogedIn();
        $actor = $this->actorDAO->getActorById($actorId);
        $opinions = $this->opinionDAO->getOpinionsPerActorId($actorId);
        $vote = $this->voteDAO->buildObject($actorId, $this->idUser);
        return $this->view->render(
            'actorView', ['actor' => $actor, 'opinions' => $opinions, 'vote' => $vote]
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