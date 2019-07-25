<?php

namespace App\Block\Posts;

class SearchRezults
{
    public function getRezultsBlock($rezults)
    {
        $html = '';
        $html .= '<div class="posts-wrapper">';
        foreach ($rezults as $post){
            $html .= $this->getPostBlock($post);
        }

        $html .= '</div>';
        return $html;
    }

    public function getPostBlock($post)
    {
        $html = '';
        $html .= '<div class="post-column">';
        $html .= '<img src="'.$post->post_img.'">';
        $html .= "<h2>$post->title</h2>";
        $html .= '<a href="'.url('post/show/'.$post->id).'">Read more...</a>';
        $html .= '</div>';

        return $html;
    }
}