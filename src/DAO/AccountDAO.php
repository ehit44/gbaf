<?php

namespace App\src\DAO;

use App\src\model\Account;

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

        return $account;
    }
    
    public function createAccount($post)
    {
        $sql = 'INSERT INTO account (nom, prenom, username, password, question, reponse) 
        VALUES (:name, :firstName, :username, :password, :question, :response)';
        $this->createQuery($sql, [
            'name' => $post['name'],
            'firstName' => $post['firstName'],
            'username' => $post['username'],
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
            'question' => $post['question'],
            'response' => $post['response'],
            ]
        );
    }
}