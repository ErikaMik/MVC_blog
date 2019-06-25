<?php

namespace App\Controller;
use Core\Controller;
class ErrorController
{
    public function classNotFound(){
        echo '404';
    }

    public function methodNotFound(){
        echo '405';
    }
}