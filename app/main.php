<?php

namespace App;

use App\Model\Course;
use App\Model\CourseCollection;
use App\Model\Player;
use App\Tool\Logger;

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