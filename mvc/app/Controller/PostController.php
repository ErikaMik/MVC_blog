<?php

namespace App\Controller;

use App\Helper\FormHelper;
use App\Model\CategoriesModel;
use Core\Controller;
use App\Helper\Helper;

class PostController extends Controller
{
    public function index()
    {
        $this->view->posts = \App\Model\PostModel::getPosts();
        $this->view->render('posts/post');
    }

    public function show($id)
    {
        $postsObject = new \App\Model\PostModel();
        $postsObject->load($id);
        $this->view->post = $postsObject;
        $this->view->render('posts/onepost');
    }

    public function create()
    {
        if(currentUser()){
        //atvaizduoti create forma [VEIKIA]
        $this->view->render('posts/admin/create');
        }else{
        echo '404';}
    }

    public function delete($id)
    {
        if(currentUser()){
            //$id = (int)$_GET['id'];
            $postModelObject = new \App\Model\PostModel();
            $postModelObject->delete($id);

            $helper = new Helper();
            $helper->redirect(url('post/'));
        } else {
            echo '404';
        }
    }
    public function store()
    {
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

    public function edit($id)
    {
        if(currentUser()){
        //$id = (int)$_GET['id'];

            
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->load($id);

        $selectedCategories = [];
        foreach($postModelObject->getCategories() as $cat){
            $selectedCategories[] = $cat->cat_id;
        }

        $form = new FormHelper(url('post/update'), 'post', 'wrapper');
        $form->addInput([
            'name' => 'title',
            'type' => 'text',
            'value' => $postModelObject->getTitle()
        ])
            ->addInput([
                'name' => 'id',
                'type' => 'hidden',
                'value' => $postModelObject->getId(),
            ])
            ->addTextarea([
             'name' => 'content'
            ], 'content', $postModelObject->getContent())
            ->addInput([
                'name' => 'post_img',
                'type' => 'text',
                'value' => $postModelObject->getImage()
            ]);

            $allCategories = CategoriesModel::getCategories();
            foreach($allCategories as $category){
            if(in_array($category->id, $selectedCategories)){
                $form->addInput([
                    'name' => 'category[]',
                    'type' => 'checkbox',
                    'checked' => 'checked',
                    'value' => $category->id,
                ], $category->name, 'cat');
            }else{
                $form->addInput([
                    'name' => 'category[]',
                    'type' => 'checkbox',
                    'value' => $category->id,
                ], $category->name, 'cat');
            }
        }

        $form->addInput([
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'OK'
        ]);

        $this->view->form = $form->get();
        $this->view->render('posts/admin/edit');
    }else{
            echo '404';
        }
    }

    public function update()
    {
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