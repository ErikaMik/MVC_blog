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
        $form = new \App\Helper\FormHelper(url('account/create'), 'post', 'registration');
        $form->addInput([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name',
        ], '', '', 'Register')
            ->addInput([
                'name' => 'email',
                'type' => 'email',
                'placeholder' => 'email@email.com',
                'class' => 'email'
            ])
            ->addInput([
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Type in password',
                'class' => 'password',
            ])
            ->addInput([
                'name' => 'password2',
                'type' => 'password',
                'placeholder' => 'Repeat password',
                'class' => 'password2',
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
        //echo Helper::generateToken();
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
        $this->view->form = $form->get();
        $this->view->render('account/login');
    }

    public function create()
    {
        if (inputHelper::checkEmail($_POST['email'])) {
            if (InputHelper::PasswordMatch($_POST['password'], $_POST['password2'])){
                $accountModelObject = new UsersModel();
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
            echo 'Could not log in<br>';
            if(!InputHelper::uniqueEmail($email)){
                $user = new UsersModel();
                $user->loadByEmail($email);

                if($user->getTriesToLogin() > 4){
                    $token = Helper::generateToken();
                    $user->setToken($token);
                    $user->save($user->getId());
                    $user->delete();

                    $headers = 'From: noreply@erikamik.site';
                    $message = url('account/activate/').$token.'?email='.$email;
                    $subject='Verify account';
                    $emailSent = mail($email, $subject, $message, $headers);

                    if( $emailSent == true ) {
                        echo "Message sent successfully... $message";
                    }else {
                        echo "Message could not be sent...";
                    }

                    //send email - NAMU DARBAS
                }else{
                    $triesToLogin = $user->getTriesToLogin() + 1;
                    $user->setTriesToLogin($triesToLogin);
                    $user->save($user->getId());
                }
            }
        }
    }

    public function activate($token)
    {
        $email = $_GET['email'];
        $user = new UsersModel();
        $user->loadByEmail($email);
        if($user->getToken() == $token){
            $user->setTriesToLogin('0');
            $user->setActive('1');
            $user->setToken('');
            $user->save($user->getId());
        }else{
            echo 'No such user';
        }
    }

    public function verify(){
        $response = [];
        $email = $_POST['email'];
        if (inputHelper::uniqueEmail($email)){
            $response['code'] = 200;
        }else{
            $response['code'] = 500;
        }
        echo json_encode($response);
    }

    public function logout()
    {
        session_destroy();
        $helper = new Helper();
        $helper->redirect(url('post/'));
    }
}