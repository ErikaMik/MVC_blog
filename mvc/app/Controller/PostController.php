<?php

namespace App\Controller;
use Core\Controller;

class PostController extends Controller
{
    public function index(){
        $postsObject = new \App\Model\PostModel();
        $this->view->posts = $postsObject->getPosts();
        $this->view->post = $postsObject->getPost(2);

        $this->view->render('page/header');
        $this->view->title = 'Pavadinimas';
        $this->view->render('posts/post');
        $this->view->render('page/footer');
    }

    public function show(){
        echo 'Vienas postas';
    }

}