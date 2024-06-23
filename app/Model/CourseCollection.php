<?php 


namespace App\Model;

use Logger;

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