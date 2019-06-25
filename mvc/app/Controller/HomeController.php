<?php

namespace App\Controller;
use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view->render('page/header');
        echo 'Contentas is Controllerio:';
        $this->view->render('page/footer');
    }
}