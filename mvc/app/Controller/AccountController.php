<?php

namespace App\Controller;

use Core\Controller;
use App\Helper\Helper;
use App\Helper\InputHelper;


class AccountController extends Controller
{
    public function index()
    {
        echo 'ok';
    }

    public function registration()
    {
        //load registration form
        $form = new \App\Helper\FormHelper('http://194.5.157.97/php2/mvc/index.php/account/auth', 'post', 'wrapper');
        $form->addInput([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name',
        ], '', '', 'Register')
            ->addInput([
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'email@email.com',
            ])
            ->addInput([
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Type in password',
            ])
            ->addInput([
                'name' => 'password2',
                'type' => 'password',
                'placeholder' => 'Repeat password',
            ])
            ->addSelect([
                1=>'admin',
                2=>'master admin',
                3=>'user'], 'city')
            ->addInput([
                'name' => 'registrate',
                'type' => 'submit',
                'value' => 'submit',
            ])->addTextarea([
                'placeholder' => 'Insert post...',
                'rows' => '20',
            ], 'content', '');
        $this->view->form =  $form->get();
        $this->view->render('account/registration');
    }

    public function login()
    {
        $form = new \App\Helper\FormHelper('http://194.5.157.97/php2/mvc/index.php/account/auth', 'post', 'wrapper');
        $form->addInput([
            'name' => 'email',
            'placeholder' => 'email@email.lt',
            'type' => 'text',
        ], '', '', 'Login')
            ->addInput([
                'name' => 'password',
                'placeholder' => 'Password',
                'type' => 'password',
            ])
            ->addInput([
                'name' => 'registrate',
                'value' => 'submit',
                'type' => 'submit',
            ]);
        $this->view->form =  $form->get();
        $this->view->render('account/login');
    }

    public function create()
    {
        if (inputHelper::checkEmail($_POST['email'])) {
            if (InputHelper::PasswordMatch($_POST['password'], $_POST['password2'])){
                $accountModelObject = new \App\Model\UsersModel();
                $accountModelObject->setName($_POST['name']);
                $accountModelObject->setEmail($_POST['email']);
                $pass = \App\Helper\InputHelper::passwordGenerator($_POST['password']);
                $accountModelObject->setPassword($pass);
                $accountModelObject->setRoleId(1);
                $accountModelObject->setActive(1);
                $accountModelObject->save();
                $helper = new Helper();
                $helper->redirect('http://194.5.157.97/php2/mvc/index.php');
            }
        }
    }

    public function auth()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $user = \App\Model\UsersModel::verification($email, $password);

        if(!empty($user)){
            // vyks dalykai prisiloginus
            echo 'You\'re loged in';
        }else{
            echo 'Could not log in';
            //Neteisingas prisijungimas
            //redirect i admin
        }
    }

}