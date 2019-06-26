<?php

namespace App\Controller;
use Core\Controller;

class PostController extends Controller
{
    public function index(){
        $postsObject = new \App\Model\PostModel();
        $this->view->posts = $postsObject->getPosts();
        $post = $this->view->post = $postsObject->getPost(1);
        $post->title;

//        $this->view->render('page/header');
        $this->view->title = 'Pavadinimas';
        $this->view->render('posts/post');
//        $this->view->render('page/footer');
    }

    public function show(){
        $id = (int)$_GET['id'];
        $postsObject = new \App\Model\PostModel();
        $this->view->post = $postsObject->getPost($id);
        $this->view->render('posts/onepost');
    }

    public function create(){
        //atvaizduoti create forma
        $this->view->render('post/admin/create');
    }

    public function store(){
        $data = $_POST;
        //kviesim PostsModel Cass ir createPost metoda
        //ivyks redirect i index metoda index.php/post
    }
}