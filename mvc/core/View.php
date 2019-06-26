<?php

namespace Core;

class View
{
    public function render($template){
        $path = __DIR__;
        $path = str_replace('core', '', $path);
        include $path.'views/'.$template.'.php';
        //include '/var/www/html/php2/mvc/views/'.$template.'.php';

    }
}