<?php

namespace App\src\DAO;

use App\src\model\Account;
use App\config\Parameter;

class AccountDAO extends DAO
{
    private function buildObject($row)
    {
        $account = new Account;
        $account->setId($row['id']);
        $account->setName($row['name']);
        $account->setFirstName($row['firstName']);
        $account->setUsername($row['username']);
        $account->setQuestion($row['question']);
        $account->setResponse($row['response']);
    }

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

    public function login(Parameter $post)
    {
        $sql = 'SELECT id_user, username, password FROM account WHERE username = ?';
        $data = $this->createQuery($sql, [$post->get('username')]);
        $result = $data->fetch();
        $isPassCorrect = password_verify(
            $post->get('password'), $result['password']
        );
        return ['result' => $result, 'isPassCorrect' => $isPassCorrect];
    }

    public function getAccountById($idUser)
    {
        $sql = 'SELECT nom, prenom, username, password, question, reponse 
        FROM account WHERE id_user = ?';
        $result = $this->createQuery($sql, [$idUser]);
        return $result->fetch();
    }
}