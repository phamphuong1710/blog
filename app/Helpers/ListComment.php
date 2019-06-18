<?php
//app/Helpers/Comment.php

use App\Comment;
use App\User;

if ( ! function_exists( 'childComment' ) ) {
    function childComment($parentId)
    {
       $comment_child = Comment::where( 'parent_id', $parentId )->get();;
        $html = '';
        if ( $comment_child ) {
            foreach ($comment_child as $comment) {
                $user = User::find($comment->user_id);
                $html .= '<ul class="list-child-comment">
                            <li class="comment-item">
                                <span class="author">'.$user->name.'</span>
                                <div class="conment_info">
                                    <a href="#" class="reply-comment" comment="'.$comment->id.'">Reply</a>
                                    <span class="created-at">'.($comment->created_at)->diffForHumans().'</span>
                                </div>
                                <span class="comment-content">'.$comment->content.'
                                </span>
                                <div class="reply-form"></div>
                            </li>'.
                                childComment($comment->id).
                        '</ul>';
            }
        }
        return $html;
    }
}


if ( ! function_exists( 'listComment' ) ) {
    function listComment($postId)
    {
       $comments = Comment::where( 'parent_id', 0 )->where( 'post_id', $postId )->get();
        $html = '';
        if ( $comments ) {
            foreach ($comments as $comment) {
                $user = User::find($comment->user_id);
                $html .= '<ul class="comment">
                            <li class="comment-item">
                                <span class="author">'.$user->name.'</span>
                                <div class="conment_info">
                                    <a href="#" class="reply-comment" comment="'.$comment->id.'">Reply</a>
                                    <span class="created-at">'.($comment->created_at)->diffForHumans().'</span>
                                </div>
                                <span class="comment-content">'.$comment->content.'
                                </span>
                                <div class="reply-form"></div>
                            </li>'
                            .childComment($comment->id).
                            '</ul>';
            }
        }

        return $html;
    }
}
