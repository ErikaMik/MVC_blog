<?php

namespace App\Controller;

use Core\Controller;
use App\Helper\Helper;

class PostController extends Controller
{
    public function index(){
        $this->view->posts = \App\Model\PostModel::getPosts();
        //$post = $this->view->post = $postsObject->getPost(1);
        //$post->title;

//        $this->view->render('page/header');
        //$this->view->title = 'Pavadinimas';
        $this->view->render('posts/post');
//        $this->view->render('page/footer');
    }

    public function show($id){
        //$id = (int)$_GET['id'];
        $postsObject = new \App\Model\PostModel();
        $postsObject->load($id);
        $this->view->post = $postsObject;
        $this->view->render('posts/onepost');
    }

    public function create(){
        if(currentUser()){
        //atvaizduoti create forma [VEIKIA]
        $this->view->render('posts/admin/create');
        }else{
        echo '404';}
    }

//    public function delete(){
//        $id = (int)$_GET['id'];
//        if(isset($id)){
//            $postsObject = new \App\Model\PostModel();
//            $postsObject->removeRecord($id);
//        }
//        $postModelObject = new \App\Model\PostModel();
//        $postModelObject->redirect('http://194.5.157.97/php2/mvc/index.php/post');
//    }

    public function delete($id)
    {
        if(currentUser()) {
            //$id = (int)$_GET['id'];
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->delete($id);

            $helper = new Helper();
            $helper->redirect(url('post/'));
        } else {
            echo '404';
        }
    }
    public function store(){
        if(currentUser()){
        $data = $_POST;
        //print_r($_POST);
        //die();
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->setTitle($_POST['title']);
        $postModelObject->setContent($_POST['content']);
        $postModelObject->setAuthorId(1);
        $postModelObject->setImage($_POST['post_img']);
        $postModelObject->save();

        $helper = new Helper();
        $helper->redirect(url('post/'));

        //kviesim PostsModel Class ir createPost metoda
        //ivyks redirect i index metoda index.php/post
    }else{
            echo '404';
        }
    }

    public function edit($id){
        if(currentUser()){
        //$id = (int)$_GET['id'];
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->load($id);
        $this->view->post = $postModelObject;
        $this->view->render('posts/admin/edit');
    }else{
            echo '404';
        }
    }

    public function update(){
        if(currentUser()){
        $data = $_POST;
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->setTitle($_POST['title']);
        $postModelObject->setContent($_POST['content']);
        $postModelObject->setAuthorId(1);
        $postModelObject->setImage($_POST['post_img']);
        $postModelObject->save($data['id']);

        $helper = new Helper();
        $helper->redirect(url('post/'));
    }else{
            echo '404';
        }
    }
}