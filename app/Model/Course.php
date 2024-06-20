<?php 

namespace App\Model;

use App\Tool\Logger;

class Course
{
    private $parcours;

    private $players;

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
        return $this;
    }

    public function getPlayer(int $idx): Player
    {
        return $this->players[$idx];
    }

    public function getAction(Player $player): string
    {
        $position = $player->getPosition();

        if (isset($this->parcours[$position + 1])) {
            switch($this->parcours[$position + 1])
            {
                case ".":
                    return "LEFT";
                    break;
                case "#":
                    return "UP";
                    break;
                default:
                    return "LEFT";
            }
        }
        return "LEFT";
    }

    public function init():void
    {
        $this->parcours = [];
        $this->players = [];
    }
}