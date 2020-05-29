<?php

namespace App\src\DAO;

use App\src\model\Account;
use App\config\Parameter;

class AccountDAO extends DAO
{

    
    public function createAccount(Parameter $post)
    {
        $sql = 'INSERT INTO account (nom, prenom, username, password, question, reponse) 
        VALUES (:name, :firstName, :username, :password, :question, :response)';
        $this->createQuery($sql, [
            'name' => $post->get('name'),
            'firstName' => $post->get('firstName'),
            'username' => $post->get('username'),
            'password' => password_hash($post->get('password'), PASSWORD_DEFAULT),
            'question' => $post->get('question'),
            'response' => $post->get('response'),
            ]
        );
    }
}