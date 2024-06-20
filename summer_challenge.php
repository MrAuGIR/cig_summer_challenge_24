<?php
// Last compile time: 20/06/24 22:58 
 





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



class Player 
{
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



class Logger
{
    public static function log($var):void
    {
        error_log(var_export($var,true));
    }
}







/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

 fscanf(STDIN, "%d", $playerIdx);
 fscanf(STDIN, "%d", $nbGames);
 
 // game loop
 while (TRUE)
 {
     for ($i = 0; $i < 3; $i++)
     {
         $scoreInfo = stream_get_line(STDIN, 64 + 1, "\n");
     }
     for ($i = 0; $i < $nbGames; $i++)
     {
         fscanf(STDIN, "%s %d %d %d %d %d %d %d", $gpu, $reg0, $reg1, $reg2, $reg3, $reg4, $reg5, $reg6);

         $course = new Course($gpu);
         
         $course->addPlayer(0,(new Player())->setPosition($reg0)->setEtourdissement($reg3));
         $course->addPlayer(1,(new Player())->setPosition($reg1)->setEtourdissement($reg4));
         $course->addPlayer(2,(new Player())->setPosition($reg2)->setEtourdissement($reg5));
     }
 
     // Write an action using echo(). DON'T FORGET THE TRAILING \n
     // To debug: error_log(var_export($var, true)); (equivalent to var_dump)
    $currentPlayer = $course->getPlayer($playerIdx);

    Logger::log($currentPlayer);

    $action = $course->getAction($currentPlayer);
    

     echo("$action\n");
 }