<?php

namespace App\Classes;

use Exception;
use Log;

class Utils
{
    public static function Exception(Exception $exception)
    {
        Log::error("Line no: ".$exception->getLine()." File: ".$exception->getFile()." Message: ".$exception->getMessage());
    }
}