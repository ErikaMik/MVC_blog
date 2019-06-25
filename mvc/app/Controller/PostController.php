<?php

namespace App\Controller;

class PostController
{
    public function __construct()
    {
        echo 'Post page';
    }

    public function index(){
        echo 'Visi postai';
    }

    public function show(){
        echo 'Vienas postas';
    }

}