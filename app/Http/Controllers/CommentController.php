<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\PostService;
use App\Http\Resources\PostResource as PostResource;
use App\Service\CommentService;
use App\Http\Resources\CommentResource as CommentResource;

class CommentController extends Controller
{
    protected $postService;
    protected $commentService;
    public function __construct(PostService $postService, CommentService $commentService)
    {
        $this->middleware('auth');
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $this->postService->getPostById($request->post_id);
        $this->commentService->addComment($request);

        return view( 'show.detail', compact('post') );
    }
}
