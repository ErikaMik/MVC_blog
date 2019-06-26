<?php
namespace App\Model;
use Core\Database;

class PostModel
{
    public function getPosts(){
        $db = new Database();
        //return $db->select('name')->from('users');
        $db->select()->from('posts');
        return $db->getAll();
    }

    public function getPost($id){
        $db = new Database();
        //return $db->select('name')->from('users');
        $db->select()->from('posts')->where('id', $id);
        return $db->get();
    }

    public function createPost($data){
        // desim i db
}
}