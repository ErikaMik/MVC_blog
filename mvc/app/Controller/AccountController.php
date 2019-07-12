<?php

namespace App\Controller;

use Core\Controller;
use App\Helper\Helper;
use App\Helper\InputHelper;
use App\Model\UsersModel;


class AccountController extends Controller
{
    public function index()
    {
        echo 'ok';
    }

    public function registration()
    {
        //load registration form
        $form = new \App\Helper\FormHelper(url('account/create'), 'post', 'wrapper');
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
                3=>'user'], 'role_id')
            ->addInput([
                'name' => 'registrate',
                'type' => 'submit',
                'value' => 'submit',
            ], '', '');
        $this->view->form =  $form->get();
        $this->view->render('account/registration');
    }

    public function login()
    {
        echo Helper::generateToken();
        $form = new \App\Helper\FormHelper('auth', 'post', 'wrapper');
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
                $pass = InputHelper::passwordGenerator($_POST['password']);
                $accountModelObject->setPassword($pass);
                $accountModelObject->setRoleId($_POST['role_id']);
                $accountModelObject->setActive(1);
                $accountModelObject->save();
                $helper = new Helper();
                $helper->redirect(url(''));
            }
        }
    }

    public function auth()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $password = InputHelper::passwordGenerator($password);
        $user = UsersModel::verification($email, $password);

        if(!empty($user)){
            // vyks dalykai prisiloginus
            //reset tries to login
            $_SESSION['user'] = $user;
            UsersModel::resetLoginNumber($user->id);
            $helper = new Helper();
            $helper->redirect(url('post/'));
        }else{
            echo 'Could not log in';
            if(!InputHelper::uniqueEmail($email)){
                $user = new UsersModel();
                $user->loadByEmail($email);

                if($user->getTriesToLogin() > 4){
                    $user->delete();
                    //send email - NAMU DARBAS
                }else{
                    $triesToLogin = $user->getTriesToLogin() + 1;
                    $user->setTriesToLogin($triesToLogin);
                    $user->save($user->getId());
                }
            }
        }
    }

    public function logout(){
        session_destroy();
        $helper = new Helper();
        $helper->redirect(url('post/'));
    }
}