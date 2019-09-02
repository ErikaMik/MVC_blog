<?php

namespace App\Controller;

use App\Helper\FormHelper;
use App\Helper\ImageHelper;
use App\Model\CategoriesModel;
use Core\Controller;
use App\Helper\Helper;
use Intervention\Image\ImageManager;

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

        $form = new \App\Helper\FormHelper(url('comments/create/').$id, 'post', 'wrapper');
        $form->addTextarea([
            'name' => 'comment',
            'placeholder' => 'Comment..',
        ], 'comment', '')
            ->addInput([
                'name' => 'submit',
                'type' => 'submit',
                'value' => 'Comment'
            ], '', 'comment-submit');

        $this->view->form = $form->get();
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

        $form = new FormHelper(url('post/update'), 'post', 'edit-post', 'enctype="multipart/form-data"');
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
                'type' => 'file',
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
        $response = [];
        $postModelObject = new \App\Model\PostModel();
        $postModelObject->load($_POST['id']);
        $postModelObject->setTitle($_POST['title']);
        $postModelObject->setContent($_POST['content']);
        $postModelObject->setAuthorId(1);
        $postModelObject->setImage($_FILES["post_img"]["name"]);
        $postModelObject->save();
        $postModelObject->setCategories($_POST['category']);

        $image = basename($_FILES["post_img"]["name"]);
        ImageHelper::imageSave($image);

        $response['msg'] = 'Post saved!';
        $response['code'] = 200;

        echo json_encode($response);
        //$helper = new Helper();
        //$helper->redirect(url('post/'));
    }else{
            echo '404';
        }
    }

}