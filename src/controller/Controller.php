<?php

namespace App\src\controller;

use App\src\DAO\OpinionDAO;
use App\src\DAO\VoteDAO;
use App\config\Request;
use App\config\Parameter;
use App\src\constraint\Validation;

abstract class Controller
{

    private $request;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;

    protected $twig;
    
    protected $idUser;

    protected $voteDAO;
    protected $opinionDAO;


    public function __construct()
    {

        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        $this->validation = new Validation();

        $this->installTwig();

        $this->idUser = $this->session->get('id_user');

        $this->voteDAO = new VoteDAO();
        $this->opinionDAO = new OpinionDAO();

    }

    private function installTwig()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'debug' => true,
            //'cache' => '/path/to/compilation_cache',
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addGlobal('session', $this->session);
    }

    protected function checkIfLogedIn($reason = 'need_login')
    {
        if(!$this->idUser and $reason === 'need_login') {
            $this->session->set('need_login', 'vous devez vous connecter pour accéder à cette page');
            header('Location: index.php?route=login');
        }
        if($this->idUser and $reason === 'need_unlogin') {
            $this->session->set('need_unlogin', 'vous êtes déjà connecté');
            header('Location: index.php?route=home');
        }
    }
    
}