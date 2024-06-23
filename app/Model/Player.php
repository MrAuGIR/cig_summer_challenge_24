<?php

namespace App\Model;

class Player 
{
    private $id;

    private $position = 0;

    private $etourdissement = 0;

    public function __construct()
    {

    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getEtourdissement():int 
    {
        return $this->etourdissement;
    }

    public function setPosition(int $position): self 
    {
        $this->position = $position;
        return $this;
    }

    public function setEtourdissement(int $etourdissement):self 
    {
        $this->etourdissement = $etourdissement;
        return $this;
    }
}