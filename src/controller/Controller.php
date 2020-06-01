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
    
    protected $idUser;


    public function __construct()
    {
        $this->view = new View();

        $this->request = new Request();
        $this->get = $this->request->getGet();
        $this->post = $this->request->getPost();
        $this->session = $this->request->getSession();
        $this->validation = new Validation();

        $this->idUser = $this->session->get('id_user');

    }

    
}