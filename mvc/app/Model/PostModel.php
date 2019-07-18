<?php
namespace App\Model;
use Core\Database;


class PostModel
{
    private $title;
    private $content;
    private $post_img;
    private $author_id;
    private $id = null;
    private $db;
    private $active;

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }



    public function __construct()
    {
        $this->db = new Database();
    }

    public function getId(){
        return $this->id;
    }

    public function setTitle($title)
    {
    $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setImage($image)
    {
        $this->post_img = $image;
    }

    public function getImage()
    {
        return $this->post_img;
    }

    public function setAuthorId($author)
    {
        $this->author_id = $author;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    // Iskelem i Helper class
//    public function redirect($url, $statusCode = 303)
//    {
//        header('Location: ' . $url, true, $statusCode);
//        die();
//    }

    public static function getPosts()
    {
        //return $this->db->select('name')->from('users');
        $db = new Database();
        $db->select()->from('posts')->where('active', 1);
        return $db->getAll();
    }

    //getPost() perrasyta i load() ir nebenaudojama
    public function getPost($id)
    {
        //return $this->db->select('name')->from('users');
        $this->db->select()->from('posts')->where('id', $id);
        return $this->db->get();
    }

    //load uzloadina ir susetina viska

    public function load($id)
    {
        $this->db->select()->from('posts')->where('id', $id);
        $post = $this->db->get();
        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->author_id = $post->author_id;
        $this->post_img = $post->post_img;
        $this->active = $post->active;
        return $this;
    }

    public function delete($id)
    {
        $setContent = "active = 0";
        $this->db->update('posts', $setContent)->where('id', $id);
        $this->db->get();
    }

    public function getCategories()
    {
        $this->db->select('cat_id')->from('category_posts_relationships')
            ->where('post_id', $this->id);
        return $this->db->getAll();
    }

    //save turi paskirstyt ar update ar create
    public function save($id = null)
    {
        if($this->id){
            $this->update();
        }else{
            $this->create();
        }
    }

    public function update()
    {
        $setContent = "title = '$this->title', content = '$this->content', post_img = '$this->post_img', 
        author_id = '$this->author_id'";
        $this->db->update('posts', $setContent)->where('id', $this->id);
        $this->db->get();
    }

    public function create()
    {
        $fields = 'title, content, author_id, post_img';
        $values = "'" .$this->title. "','" .$this->content. "','" .$this->author_id. "','" .$this->post_img. "'";
        $this->db = new Database();
        $this->db->insert('posts', $fields, $values);
        return $this->db->get();
    }

    public function setCategories($categories)
    {
        $this->db->delete()->from('category_posts_relationships')
            ->where('post_id', $this->id)->get();

        $columns = 'cat_id, post_id';
        foreach($categories as $category){
            $values = "$category, $this->id";
            $this->db->insert('category_posts_relationships', $columns, $values)->get();
        }
    }


}