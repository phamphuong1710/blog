<?php
namespace App\Service;

use App\InterfaceService\CommentInterface;
use App\Comment; // model
/**
 *
 */
class CommentService implements CommentInterface
{
    public function getParentComment($postId)
    {
        $comments = Comment::where( 'parent_id', 0 )->where( 'post_id', $postId )->get();
        return $comments;
    }

    public function getChildComment($parentId)
    {
        $comment_child = Comment::where( 'parent_id', $parentId )->get();
        return $comment_child;
    }

    public function addComment($request)
    {
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->parent_id;
        $comment->save();
    }

}
