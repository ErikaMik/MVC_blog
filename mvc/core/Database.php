<?php

namespace Core;

class Database
{
    private $pdo;
    private $sql = '';

    public function connect(){ //klase atsakinga uz darba su duomenu baze
        $host = '127.0.0.1';
        $db = 'blog';
        $user = 'ErikaMik';
        $password = '#DamnSoul666';
        $pdo = null;
        try {
            $pdo = new \PDO("mysql:host=$host; dbname=$db; charset=utf8", $user, $password);
        } catch (PDOException $e) {
//            print 'ERROR: ' . $e->getMessage();
        }
       $this->pdo = $pdo;
    }

    public function select($fields = '*'){ //pasirenkam ka selectinsim
        $this->sql .='SELECT '.$fields;
        return $this;
    }

    public function from($table){
        $this->sql .= ' FROM ' .$table;
        return $this;
    }

    public function get()
    {
        $this->connect();
        $sql = $this->sql; //"SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetchObject();
        return $user;
    }

    public function where($fieldanme, $value){
        $this->sql .= ' WHERE ' .$fieldanme. ' = ' .$value;
        return $this;
    }
}

//$DB = new Database();
//$DB->connect();