<?php
 namespace App\Controller;

use \App\Helper\FormHelper;

 class FormController
 {
    public function login()
    {
        $login = new FormHelper('post', 'http://194.5.157.97/php2/mvc/index.php/account/login', 'wrapper');
        $login->inputName('email')->inputType('email')->inputPlaceholder('email@email.com')->formEnd();
        echo $login;
    }
 }