<?php

namespace App\src\DAO;

use App\src\model\Account;
use App\config\Parameter;

class AccountDAO extends DAO
{
    private function buildObject($row)
    {
        $account = new Account;
        $account->setId($row['id_user']);
        $account->setName($row['nom']);
        $account->setFirstName($row['prenom']);
        $account->setUsername($row['username']);
        $account->setQuestion($row['question']);
        $account->setResponse($row['reponse']);

        return $account;
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

    public function checkIfUsernameExists($username)
    {
        $sql = 'SELECT username FROM account WHERE username = ?';
        $data = $this->createQuery($sql, [$username]);
        if($data->rowCount()) {
            return true;
        } 
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
        $sql = 'SELECT id_user, nom, prenom, username, password, question, reponse 
        FROM account WHERE id_user = ?';
        $result = $this->createQuery($sql, [$idUser]);
        
        return $this->buildObject($result->fetch());
    }

    public function editAccount(Parameter $post, $idUser)
    {
        $sql = 'UPDATE account 
        SET nom = :name, prenom = :firstName, username = :username, 
        password = :password, question = :question, reponse = :response
        WHERE id_user = :idUser';
        
        $this->createQuery($sql, [
            'name' => $post->get('name'),
            'firstName' => $post->get('firstName'),
            'username' => $post->get('username'),
            'password' => password_hash($post->get('password'), PASSWORD_DEFAULT),
            'question' => $post->get('question'),
            'response' => $post->get('response'),
            'idUser' => $idUser
        ]);
    }
}