<?php

namespace App\Controller;

use App\Helper\FormHelper;
use Core\Controller;

class LoginController extends Controller
{

    public function login()
    {
        $form = new FormHelper('http://194.5.157.97/php2/mvc/index.php/account/login','post', 'wrapper');
        $form->addInput([
            'name' => 'email',
            'placeholder' => 'email@email.lt',
            'type' => 'text',
            'class' => 'wrapper',
        ])
            ->addInput([
                'name' => 'password',
                'placeholder' => 'Password',
                'type' => 'password',
                'class' => 'wrapper',
            ]);
        $this->view->form =  $form->get();
        $this->view->render('page/login');
    }
}