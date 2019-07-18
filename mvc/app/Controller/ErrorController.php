<?php

namespace App\Controller;
use Core\Controller;
class ErrorController
{
    public function classNotFound(){
        echo '404 - class not found';
    }

    public function methodNotFound(){
        echo '405 - method not found';
    }
}