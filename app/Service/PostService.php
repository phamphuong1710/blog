<?php
namespace App\Service;

use App\InterfaceService\PostInterface;
use App\Post; // model
/**
 *
 */
class PostService implements PostInterface
{
    public function getAll()
    {
        $posts =  Post::paginate(6);
        return $posts;
    }

    public function getPostById($post)
    {
        $post = Post::find($post);
        return $post;
    }

    public function getPostIdMax()
    {
        $id = Post::max('id');
        return $id;
    }

    public function createPost($data)
    {
        $post = new Post($data);
        $post->save();
    }

    public function deletePost($post)
    {
        Post::destroy( $post );
    }
}

