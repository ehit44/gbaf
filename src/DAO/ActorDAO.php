<?php

namespace App\src\DAO;

use App\src\model\Actor;
use App\config\Parameter;

class ActorDAO extends DAO
{
    private function buildObject($row)
    {
        $actor = new Actor();
        $actor->setId($row['id_acteur']);
        $actor->setActor($row['acteur']);
        $actor->setDescription($row['description']);
        $actor->setLogo($row['logo']);

        return $actor;
    }

    public function getAllActors()
    {
        $sql = 'SELECT id_acteur, acteur, description, logo FROM acteur';
        $result = $this->createQuery($sql);
        $data = $result->fetchAll();
        $actors = [];

        foreach ($data as $row) {
            $actors += [$row['id_acteur'] => $this->buildObject($row)];
        }
        $result->closeCursor();
        return $actors;
    }

    public function getActorById($actorId)
    {
        $sql = 'SELECT id_acteur, acteur, description, logo FROM acteur
        WHERE id_acteur = ?';
        $result = $this->createQuery($sql, [$actorId]);
        $data = $result->fetch();

        $actor = $this->buildObject($data);
        $result->closeCursor();

        return $actor;
    }

}