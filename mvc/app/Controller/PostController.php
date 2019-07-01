<?php

namespace App\Controller;
use Core\Controller;

class PostController extends Controller
{
    public function index(){
        $postsObject = new \App\Model\PostModel();
        $this->view->posts = $postsObject->getPosts();
        //$post = $this->view->post = $postsObject->getPost(1);
        //$post->title;

//        $this->view->render('page/header');
        $this->view->title = 'Pavadinimas';
        $this->view->render('posts/post');
//        $this->view->render('page/footer');
    }

    public function show(){
        $id = (int)$_GET['id'];
        $postsObject = new \App\Model\PostModel();
        $postsObject->load($id);
        $this->view->post = $postsObject;
        $this->view->render('posts/onepost');
    }

    public function create(){
        //atvaizduoti create forma [VEIKIA]
        $this->view->render('posts/admin/create');
    }

    public function delete(){
        $id = (int)$_GET['id'];
        if(isset($id)){
            $postsObject = new \App\Model\PostModel();
            $postsObject->removeRecord($id);
        }
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->redirect('http://194.5.157.97/php2/mvc/index.php/post');
    }

    public function store(){
        $data = $_POST;
        //print_r($_POST);
        //die();
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->setTitle($_POST['title']);
        $postModelObject->setContent($_POST['content']);
        $postModelObject->setAuthorId(1);
        $postModelObject->setImage($_POST['post_img']);
        $postModelObject->save();

        $postModelObject->redirect('http://194.5.157.97/php2/mvc/index.php/post');

        //kviesim PostsModel Class ir createPost metoda
        //ivyks redirect i index metoda index.php/post
    }

    public function edit(){
        $id = (int)$_GET['id'];
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->load($id);
        $this->view->post = $postModelObject;
        $this->view->render('posts/admin/edit');
    }

    public function update(){
        $data = $_POST;
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->setTitle($_POST['title']);
        $postModelObject->setContent($_POST['content']);
        $postModelObject->setAuthorId(1);
        $postModelObject->setImage($_POST['post_img']);
        $postModelObject->save($data['id']);

        $postModelObject->redirect('http://194.5.157.97/php2/mvc/index.php/post');
    }
}