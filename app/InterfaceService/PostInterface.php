<?php

namespace App\InterfaceService;

interface PostInterface {
    public function getAll();
    public function getPostById($post);
    public function getPostIdMax();
    public function createPost($data);
    public function deletePost($post);
}
