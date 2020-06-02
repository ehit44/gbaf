<?php

namespace App\src\DAO;

use App\config\Parameter;

class VoteDAO extends DAO
{
    public function getVoteStatus($actorId, $userId)
    {
        $sql = 'SELECT vote FROM vote WHERE id_acteur = ? AND id_user = ? ';
        $result = $this->createQuery($sql, [$actorId, $userId]);
        $data = $result->fetch();
        return $data['vote'];
    }
    
    public function updateVote($actorId, $userId, $vote)
    {
        $sql = 'UPDATE vote SET vote = ? WHERE id_acteur = ? AND id_user = ?';
        $result = $this->createQuery($sql, [$vote, $actorId, $userId]);
    }
    
    public function deleteVote($actorId, $userId)
    {
        $sql = 'DELETE FROM vote WHERE id_acteur = ? AND id_user = ?';
        $result = $this->createQuery($sql, [$actorId, $userId]);
    }
    
    public function addVote($actorId, $userId, $vote)
    {
        $sql = 'INSERT INTO vote (id_acteur, id_user, vote) VALUES (?, ?, ?)';
        $result = $this->createQuery($sql, [$actorId, $userId, $vote]);
    }

}