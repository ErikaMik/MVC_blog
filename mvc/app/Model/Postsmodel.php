<?php
namespace App\Model;
use Core\Database;

class PostModel
{
    private $title;
    private $content;
    private $post_img;
    private $author_id;

    public function setTitle($title){
    $this->title = $title;
}

    public function getTitle(){
        return $this->title;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getContent(){
        return $this->content;
    }

    public function setImage($image){
        $this->post_img = $image;
    }

    public function getImage()
    {
        return $this->post_img;
    }

    public function setAuthorId($author){
        $this->author_id = $author;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    public function getPosts(){
        $db = new Database();
        //return $db->select('name')->from('users');
        $db->select()->from('posts');
        return $db->getAll();
    }

    //getPost() perrasyta i load() ir nebenaudojama
    public function getPost($id){
        $db = new Database();
        //return $db->select('name')->from('users');
        $db->select()->from('posts')->where('id', $id);
        return $db->get();
    }

    //load uzloadina ir susetina viska

    public function load($id){
        $db = new Database();
        $db->select()->from('posts')->where('id', $id);
        $post = $db->get();
        $this->title = $post->title;
        $this->content = $post->content;
        $this->author_id = $post->author_id;
        $this->post_img = $post->post_img;
    }

    public function save(){
        $fields = 'title, content, author_id, post_img';
        $values = "'" .$this->title. "','" .$this->content. "','" .$this->author_id. "','" .$this->post_img. "'";
        $db = new Database();
        $db->insert('posts', $fields, $values);
        return $db->get();
    }

}