<?php
// Last compile time: 23/06/24 19:16 
 





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






class CourseCollection
{
    /**
     *
     * @var Course[] $courses
     */
    private $courses = [];

    private $memo_action = [];

    public function add(int $index, Course $course):self 
    {
        $this->courses[$index] = $course;
        return $this;
    }

    public function getCourse(int $index): ?Course
    {
        if (isset($this->courses[$index])) {
            return $this->courses[$index];
        }
        return null;
    }


    public function getAction(int $playerIdx):string
    {
        $actions = [];

        foreach ($this->courses as $key => $course) {

            $currentPlayer = $course->getPlayer($playerIdx);

            if ($currentPlayer->getEtourdissement() > 0) {
                Logger::log($currentPlayer);
                continue;
            }

            $position = $currentPlayer->getPosition();
            $parcours = $course->parcours;

            if (isset($parcours[$position + 1])) {
                $lines = $this->getLine($position,$parcours);
    
                // c'est dégueulasse !
                if ($lines <= 1) {
                    $actions[] = "UP";
                } elseif ($lines <= 3) {
                    $actions[] = "DOWN";
                } else {
                    $actions[] = "RIGHT";
                }
            }
        }

        return $this->chooseAction($actions);
    }


    private function getLine(int $currentPosition, array $parcours): int
    {
        $brick = 0;
        for($i = $currentPosition; $i < count($parcours) - 1;$i++)
        {
            if (!isset($parcours[$i]) || $parcours[$i] === '#') {
                return $brick;
            }
            $brick += 1;
        }
        return $brick;
    }

    private function chooseAction(array $actions): string 
    {
        $action_counts = array_count_values($actions);

        if (count($action_counts) === 1) {
            return array_key_first($action_counts);
        }

        $most_common_action = array_search(max($action_counts), $action_counts);
        return $most_common_action;
    }


}



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

 // collection
 $collection = new CourseCollection();
 
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

         $collection->add($i,$course);
     }
 
     // Write an action using echo(). DON'T FORGET THE TRAILING \n
     // To debug: error_log(var_export($var, true)); (equivalent to var_dump)
    
    $action = $collection->getAction($playerIdx);
    
     echo("$action\n");
 }