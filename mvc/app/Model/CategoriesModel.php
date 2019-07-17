<?php

namespace App\Model;

use Core\Database;

class CategoriesModel
{
    private $id;
    private $name;
    private $description;
    private $parentId;
    private $slug;
    private $active;
    private $db;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }


    public static function getCategories()
    {
        $db = new Database();
        $db->select()->from('categories')->where('active', 1);
        return $db->getAll();
    }

    public function save($id = null)
    {
        if($id !== null){
            $this->id = $id;
            $this->update();
        }else{
            $this->create();
        }
    }

    public function update()
    {
        $setContent = "name = '$this->name', description = '$this->description', parent_id = '$this->parentId', 
        slug = '$this->slug'";
        $this->db->update('categories', $setContent)->where('id', $this->id);
        $this->db->get();
    }

    public function create()
    {
        $fields = 'name, description, parent_id, slug';
        $values = "'" .$this->name. "','" .$this->description. "','" .$this->parentId. "','" .$this->slug. "'";
        $this->db = new Database();
        $this->db->insert('categories', $fields, $values);
        return $this->db->get();
    }

    public static function getParentCategories()
    {
        $db = new Database();
        $db->select('id, name, slug')
            ->from('categories')
            ->where('parent_id', 0)
            ->andWhere('active', 1);
        return $db->getAll();
    }

    public function load($id)
    {
        $this->db->select()->
        from('categories')
            ->where('id', $id);
        $category = $this->db->get();
        $this->id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->parentId = $category->parent_id;
        $this->slug = $category->slug;
        return $this;
    }

    public function loadBySlug($slug)
    {
        $this->db->select('id')
            ->from('categories')
            ->where('slug', $slug);
        $category = $this->db->get();
        $this->load($category->id);
    }

    public function getPosts()
    {
        $this->db->select('post_id')
            ->from('category_posts_relationships')
            ->where('cat_id', $this->id);

        return $this->db->getAll();
    }

    public static function getAllCategories()
    {
        $db = new Database();
        $db->select()->from('categories')->where('active', 1);
        return $db->getAll();
    }

}