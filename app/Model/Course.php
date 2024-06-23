<?php 

namespace App\Model;

use App\Tool\Logger;

class Course
{
    public $parcours;

    public $players;

    public function __construct(string $parcours)
    {
        $value = str_split($parcours);
        if ($value === "GAME_OVER") {
            $this->init();
        }
        $this->parcours = $value;
    }


    public function addPlayer(int $idx, Player $player): self 
    {
        $this->players[$idx] = $player;
        $this->players[$idx]->int = $idx;
        return $this;
    }

    public function getPlayer(int $idx): Player
    {
        return $this->players[$idx];
    }

   
    public function init():void
    {
        $this->parcours = [];
        $this->players = [];
    }
}