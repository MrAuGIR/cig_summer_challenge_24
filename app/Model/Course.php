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
            $lines = $this->getLine($position);

            // c'est dégueulasse !
            if ($lines <= 1) {
                return "UP";
            } elseif ($lines <= 3) {
                return "DOWN";
            } else {
                return "RIGHT";
            }
        }
        return "LEFT";
    }

    public function init():void
    {
        $this->parcours = [];
        $this->players = [];
    }

    private function getLine(int $currentPosition): int
    {
        $brick = 0;
        for($i = $currentPosition; $i < count($this->parcours) - 1;$i++)
        {
            if (!isset($this->parcours[$i]) || $this->parcours[$i] === '#') {
                return $brick;
            }
            $brick += 1;
        }
        return $brick;
    }
}