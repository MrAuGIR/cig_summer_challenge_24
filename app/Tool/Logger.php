<?php 

namespace App\Tool;

class Logger
{
    public static function log($var):void
    {
        error_log(var_export($var,true));
    }
}