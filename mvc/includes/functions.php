<?php

function url($path, $param = 0){

    $url = 'http://194.5.157.97/php2/mvc/index.php/'.$path;
    if($param !== 0){
        $url = $url.'/'.$param;
    }
    return $url;

}

function currentUser()
{
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        return 0;
    }
}

    function debug($data)
    {
        echo '<pre>';
        print_r($data);
        die();
    }

