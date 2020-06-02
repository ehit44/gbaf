<?php

namespace App\src\model;

class Opinion 
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $actorId;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $opinion;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * @return string
     */
    public function getActorId()
    {
        return $this->actorId;
    }

    /**
     * @param string $actorId
     */
    public function setActorId($actorId)
    {
        $this->actorId = $actorId;
    }
    
    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
    
    /**
     * @return string
     */
    public function getOpinion()
    {
        return $this->opinion;
    }

    /**
     * @param string $opinion
     */
    public function setOpinion($opinion)
    {
        $this->opinion = $opinion;
    }
}