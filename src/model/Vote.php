<?php

namespace App\src\model;

class Vote 
{
    /**
     * @var int
     */
    private $positiveVoteNb;

    /**
     * @var int
     */
    private $negativeVoteNb;

    /**
     * @var string
     */
    private $positiveIcon;

    /**
     * @var string
     */
    private $negativeIcon;

    /**
     * @return int
     */
    public function getPositiveVoteNb()
    {
        return $this->positiveVoteNb;
    }

    /**
     * @param int $positiveVoteNb
     */
    public function setPositiveVoteNb($positiveVoteNb)
    {
        $this->positiveVoteNb = $positiveVoteNb;
    }

    /**
     * @return int
     */
    public function getNegativeVoteNb()
    {
        return $this->negativeVoteNb;
    }

    /**
     * @param int $negativeVoteNb
     */
    public function setNegativeVoteNb($negativeVoteNb)
    {
        $this->negativeVoteNb = $negativeVoteNb;
    }
    
    /**
     * @return string
     */
    public function getPositiveIcon()
    {
        return $this->positiveIcon;
    }

    /**
     * @param string $positiveIcon
     */
    public function setPositiveIcon($positiveIcon)
    {
        $this->positiveIcon = $positiveIcon;
    }
    
    /**
     * @return string
     */
    public function getNegativeIcon()
    {
        return $this->negativeIcon;
    }

    /**
     * @param string $negativeIcon
     */
    public function setNegativeIcon($negativeIcon)
    {
        $this->negativeIcon = $negativeIcon;
    }
}