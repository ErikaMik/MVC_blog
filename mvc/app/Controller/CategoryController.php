<?php

namespace App\Controller;

use App\Helper\FormHelper;
use App\Helper\Helper;
use App\Model\CategoriesModel;
use App\Model\PostModel;
use Core\Controller;


class CategoryController extends Controller
{
    public function index()
    {
        echo 'OK';
    }

    public function create()
    {
        $categories = \App\Model\CategoriesModel::getCategories();
        $options = [0 => 'Pasirinkti parent kategorija'];
        foreach ($categories as $category){
            $options[$category->id] = $category->name;
        }

        $form = new FormHelper(url('category/store'), 'post', 'wrapper');
        $form->addInput([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Category Name'
        ])
            ->addInput([
                'name' => 'description',
                'type' => 'text',
                'placeholder' => 'Description',
            ])
            ->addSelect($options, 'parent_id')
        ->addInput([
            'name' => 'registrate',
            'type' => 'submit',
            'value' => 'submit',
        ], '', '');
        $this->view->form = $form->get();
        $this->view->render('category/create');
    }

    public function store()
    {
        $helper = new Helper();
        $slug = $helper->makeSlug($_POST['name']);

        $categoryModel = new CategoriesModel();
        $categoryModel->setName($_POST['name']);
        $categoryModel->setDescription($_POST['description']);
        $categoryModel->setParentId($_POST['parent_id']);
        $categoryModel->setSlug($slug);
        $categoryModel->save();
    }

    public function show($slug)
    {
        $category = new CategoriesModel();
        $category->loadBySlug($slug);
        $posts = [];
        foreach($category->getPosts() as $post){
            $postObject = new PostModel();
            $postObject->load($post->post_id);

            if($postObject->getActive() == 1) {
                $posts[] = $postObject;
            }
        }

        $this->view->categoryName = $category->getName();
        $this->view->posts = $posts;
        $this->view->render('category/view');
    }




}