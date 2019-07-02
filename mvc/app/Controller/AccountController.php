<?php

namespace App\Controller;

use Core\Controller;
use App\Helper\Helper;


class AccountController extends Controller
{
    public function index()
    {
        echo 'ok';
    }

    public function registration()
    {
        //load registration form
        $this->view->render('account/registration');
    }

    public function login()
    {
        //load login form
        $this->view->render('account/login');
    }

    public function create()
    {
        $data = $_POST;
        //create user from form
        $usersModelObject = new \App\Model\UsersModel();
        $usersModelObject->setName($_POST['name']);
        $usersModelObject->setEmail($_POST['email']);
        $pass = \App\Helper\InputHelper::passwordGenerator($data['$password']);
        $usersModelObject->setPassword($pass);
        $usersModelObject->setRoleId(1);

        $usersModelObject->save();

        $helper = new Helper();
        $helper->redirect('http://194.5.157.97/php2/mvc/index.php/post');
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
            echo 'could not log in';
            //Neteisingas prisijungimas
            //redirect i admin
        }
    }

}