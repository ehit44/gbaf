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
        $opinion->setUserId($row['id_user']);
        $opinion->setDate($row['date_add']);
        $opinion->setOpinion($row['post']);

        return $opinion;
    }

    /*public function getOpinionsPerActorId($actorId)
    {
        $sql = 'SELECT id_post, id_user, id_acteur, date_add, post 
        FROM post WHERE id_acteur = ?';
        $result = $this->createQuery($sql, [$actorId]);
        $data = $result->fetchAll();
        $opinions = [];

        foreach ($data as $row) {
            $opinions += [$row['id_post'] => $this->buildObject($row)];
        }
        $result->closeCursor();
        return $opinions;
    }*/

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