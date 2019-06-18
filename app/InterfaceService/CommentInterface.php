<?php

namespace App\InterfaceService;

interface CommentInterface {
    public function getParentComment($postId);
    public function getChildComment($parentId);
    public function addComment($request);
}
