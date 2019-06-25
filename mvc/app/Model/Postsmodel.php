<?php
namespace App\Model;
use Core\Database;

class PostModel
{
    public function getPosts(){
        $db = new Database();
        //return $db->select('name')->from('users');
        $db->select()->from('users');
        return $db->get();
    }

    public function getPost($id){
        $db = new Database();
        //return $db->select('name')->from('users');
        $db->select()->from('users')->where('id', $id);
        return $db->get();
    }
}