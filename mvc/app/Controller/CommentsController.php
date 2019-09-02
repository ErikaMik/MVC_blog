<?php

namespace App\Controller;

use App\Model\CommentsModel;
use Core\Controller;
use App\Helper\Helper;
use App\Block\Posts\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        $this->view->render('posts/comments');
    }

//    public function comment()
//    {
//        $form = new \App\Helper\FormHelper(url('comments/create'), 'post', 'comment');
//        $form->addTextarea([
//            'name' => 'comment',
//            'placeholder' => 'Comment..',
//        ], 'comment', '')
//            ->addInput([
//            'name' => 'submit',
//            'type' => 'submit',
//            'value' => 'OK'
//        ]);
//
//        $this->view->form = $form->get();
//        $this->view->render('posts/comments');
//    }

    public function create($id)
    {
        if(currentUser() && $_POST['comment'] != ''){
            $commentObject = new CommentsModel();
            $commentObject->setComment($_POST['comment']);
            $commentObject->setAuthorId(currentUser()->id);
            $commentObject->setActive(1);
            //$commentObject->setPostId(11);
            $commentObject->setPostId($id);
            $commentObject->createComment();

            $helper = new Helper();
            $helper->redirect(url('post/show/').$id);
        }else{
            $helper = new Helper();
            $helper->redirect(url('post/show/').$id);
        }
    }

    public function show($id)
    {
        $comments = CommentsModel::getComments($id);
        $block = new Comments();
        echo $block->getCommentsBlock($comments);
    }

}