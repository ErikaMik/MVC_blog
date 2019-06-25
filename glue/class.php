<?php

class Customers
{
    private $name;
    private $email;
    private $username;
    private $password;

    public function __construct($name, $email, $username, $password)
    {
        $this->setName($name); // pavyzdys, kad galima kreipti i savo paties metoda
        $this->email = $email; 
		$this->username = $username;
        $this->password = $password;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }
}

class User
{
    public function getUser($name){
        return '<h1>Vardas: '.$name.'</h1>';
    }
    public function getUserEmail($email){
        return '<h2>El. pastas: '.$email.'</h2>';
    }
    public function getUserName($username){
        return '<h2>Username: '.$username.'</h2>';
    }
    public function getUserPass($password){
        return '<h2>Password: '.$password.'</h2>';
    }
}

$customers  = new Customers('Erika', 'email@email.com', 'KazkoksName', 'KazkoksPASS');
$user = new User;

echo $customers->getName();
echo '<br>';
echo $customers->getEmail();
echo '<br>';
echo $customers->getUsername();
echo '<br>';
echo $customers->getPassword();
$x = $customers->getName();
echo $user->getUser($x);
echo $user->getUserEmail($customers->getEmail());
echo $user->getUserName($customers->getUsername());
echo $user->getUserPass($customers->getPassword());

$customers->setName('Tadas');
echo $user->getUser($customers->getName());

