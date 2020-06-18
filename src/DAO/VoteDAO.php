<?php

namespace App\src\DAO;

use App\src\model\Vote;

class VoteDAO extends DAO
{
    public function buildObject($actorId, $userId)
    {
        $vote = new Vote();
        $vote->setPositiveVoteNb($this->getVoteNb($actorId, '1'));
        $vote->setNegativeVoteNb($this->getVoteNb($actorId, '0'));
        
        $icon = $this->voteStatusIcon($actorId, $userId);
        $vote->setPositiveIcon($icon['positiveIcon']);
        $vote->setNegativeIcon($icon['negativeIcon']);

        return $vote;
    }

    public function deleteVoteFromAccount($idUser)
    {
        $sql = 'DELETE FROM vote WHERE id_user = ?';
        $result = $this->createQuery($sql, [$idUser]);

        return $result;
    }

    private function getVoteNb($actorId, $vote)
    {
        $sql = 'SELECT COUNT(*) as voteNb FROM vote WHERE id_acteur =? AND vote = ?';
        $result = $this->createQuery($sql, [$actorId, $vote]);
        $data = $result->fetch();
        return $data['voteNb'];
    }
    
    private function voteStatusIcon($actorId, $userId)
    {
        $voteStatus = $this->getVoteStatus($actorId, $userId);
        if($voteStatus === '0') {
            $icon = ['positiveIcon' => 'positive-vote.png', 'negativeIcon' => 'negative-vote-bold.png'];
        } elseif ($voteStatus === '1') {
            $icon = ['positiveIcon' => 'positive-vote-bold.png', 'negativeIcon' => 'negative-vote.png'];
        } else {
            $icon = ['positiveIcon' => 'positive-vote.png', 'negativeIcon' => 'negative-vote.png'];
        }
        return $icon;
    }
    
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