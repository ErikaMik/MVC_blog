<?php

namespace App\Controller;

use App\Block\Posts\SearchRezults;
use App\Model\PostModel;
use Core\Controller;

class SearchController extends Controller
{
    public function index()
    {
        $this->view->render('posts/search-rezults');
    }

    public function search()
    {
        $keyword = $_GET['keyword'];
        if($keyword !== ''){
            $rezults = PostModel::getSearchRezults($keyword);
            $block = new SearchRezults();
            echo $block->getRezultsBlock($rezults);
        }

    }
}