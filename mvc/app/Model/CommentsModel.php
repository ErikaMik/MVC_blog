<?php

namespace App\Model;

use Core\Database;

class CommentsModel
{
    private $id;
    private $author_id;
    private $comment;
    private $active;
    private $date;
    private $post_id;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }


    public function createComment()
    {
        $fields = 'author_id, comment, active, post_id';
        $values = "'" .$this->author_id. "','" .$this->comment. "','" .$this->active. "','" .$this->post_id. "'";
        $this->db = new Database();
        $this->db->insert('comments', $fields, $values);
        return $this->db->get();
    }

    public static function getComments($id)
    {
        $db = new Database();
        $db->select()->from('comments')->where('post_id', $id);
        return $db->getAll();
    }

    public function delete($id)
    {
        $setContent = "active = 0";
        $this->db->update('comments', $setContent)->where('id', $id);
        $this->db->get();
    }



}