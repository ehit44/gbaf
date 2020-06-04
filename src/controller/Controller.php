<?php

namespace App\src\controller;

use App\src\model\View;
use App\config\Request;
use App\config\Parameter;
use App\src\constraint\Validation;

abstract class Controller
{
    protected $view;

    private $request;
    protected $get;
    protected $post;
    protected $session;
    protected $validation;

    protected $twig;
    
    protected $idUser;


    public function __construct()
    {
        $this->view = new View();

        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        $this->validation = new Validation();

        $this->installTwig();

        $this->idUser = $this->session->get('id_user');

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

    protected function checkIfLogedIn()
    {
        if(!$this->idUser) {
            $this->session->set('need_login', 'vous devez vous connecter pour accéder à cette page');
            header('Location: index.php?route=login');
        }
    }
    
}