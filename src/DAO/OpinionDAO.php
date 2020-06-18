<?php

namespace App\src\DAO;

use App\src\model\Opinion;
use App\config\Parameter;

class OpinionDAO extends DAO
{
    private function buildObject($row)
    {
        $opinion = new Opinion();
        $opinion->setId($row['id_post']);
        $opinion->setActorId($row['id_acteur']);
        $opinion->setUsername($row['username']);
        $date = date("d/m/Y", strtotime($row['date_add']));
        $opinion->setDate($date);
        $opinion->setOpinion($row['post']);

        return $opinion;
    }

    public function deleteOpinionFromAccount($idUser)
    {
        $sql = 'DELETE FROM post WHERE id_user = ?';
        $result = $this->createQuery($sql, [$idUser]);

        return $result;
    }

    public function getOpinionsPerActorId($actorId)
    {
        $sql = 'SELECT id_post, username, id_acteur, date_add, post 
        FROM post LEFT JOIN account on account.id_user = post.id_user 
        WHERE id_acteur = ? ORDER BY date_add DESC';
        $result = $this->createQuery($sql, [$actorId]);
        $data = $result->fetchAll();
        $opinions = [];

        foreach ($data as $row) {
            $opinions += [$row['id_post'] => $this->buildObject($row)];
        }
        $result->closeCursor();
        return $opinions;
    }

    public function postOpinion(Parameter $post, $actorId, $userId)
    {
        $sql = 'INSERT INTO post (id_user, id_acteur, date_add, post)
        VALUES (:id_user, :id_acteur, NOW(), :post)';
        $result = $this->createQuery($sql, [
            'id_user' =>$userId,
            'id_acteur' => $actorId,
            'post' => $post->get('opinion'),
            ]);

        return $result;
    }
}