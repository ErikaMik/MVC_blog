<?php

namespace App\Block\Posts;

class Comments
{
    public function getCommentsBlock($comments)
    {
        $html = '';
        $html .= '<div class="comments-wrapper">';
        foreach ($comments as $comment){
            $html .= $this->getCommentBlock($comment);
        }

        $html .= '</div>';
        return $html;
    }

    public function getCommentBlock($comment)
    {
        $html = '';
        $html .= '<div class="comment">';
        $html .= "<h4>$comment->date</h4>";
        $html .= "<p>$comment->comment</p>";
        $html .= '</div>';

        return $html;
    }
}