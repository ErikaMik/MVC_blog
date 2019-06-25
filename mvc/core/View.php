<?php

namespace Core;

class View
{
    public function render($template){
        
        include '/var/www/html/php2/mvc/views/'.$template.'.php';

    }
}