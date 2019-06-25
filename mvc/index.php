<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use App\Helper\Helper; //tas pats kas include app/helper.php

//echo '<pre>';
//print_r($_SERVER);

if(isset($_SERVER['PATH_INFO'])){
    $path = $_SERVER['PATH_INFO'];
}else{
    $path = '/';
}

$path = explode('/', $path);
$helper = new Helper();
//print_r($path);

//check if $path[1] isset and not empty...
if(isset($path[1]) && !empty($path[1])){
    $controller = $helper->getController($path[1]);
//    echo $controller;
    if(isset($path[2]) && !empty($path[2])){
        $method = $path[2];
//        echo $method;
    } else {
        $method = 'index';
    }
    if(class_exists($controller)){
        $object = new $controller; // or $object = new \App\Controller\PostController;
        if(method_exists($object, $method)){
            $object->{$method}();
        } else {
            $object = new \App\Controller\ErrorController();
            $object->methodNotFound();
//          echo '405';
        }
    } else {
        $object = new \App\Controller\ErrorController();
        $object->classNotFound();
//      echo '404';
    }

} else {
    $object = new \App\Controller\HomeController();
}

require 'views/page/header.php';
require 'views/page/footer.php';

