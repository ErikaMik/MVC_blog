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

    public function insert($table, $fields, $values){
        $this->sql .= 'INSERT INTO ' .$table. '(' .$fields. ')' . ' VALUES ' . '(' . $values . ')';
        return $this;
    }

    public function update($table){

        return $this;
    }

    public function andWhere(){

        return $this;
    }

    public function delete(){

        return $this;
    }

    public function execute(){
        $this->connect();
        $sql = $this->sql;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function getAll()
    {
       $stmt = $this->execute();
       $data = [];
        while($row = $stmt->fetchObject()){
            $data[] = $row;
        }
        return $data;
    }

    public function get()
    {
        $stmt = $this->execute();
        return $stmt->fetchObject();
//        $data = [];
//        while($row = $stmt->fetchObject()){
//            $data[] = $row;
//        }
//        if(count($data) == 1){  //isima elementa is array, turim nebe array, o objekta
//            $data = $data[0];
//        }
//        return $data;
    }

    public function where($fieldanme, $value){
        $this->sql .= ' WHERE ' .$fieldanme. ' = ' .$value;
        return $this;
    }
}

//$DB = new Database();
//$DB->connect();