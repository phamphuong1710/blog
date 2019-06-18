<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Service\PostService;
use App\Http\Resources\PostResource as PostResource;
use App\Service\CategoryService;
use App\Http\Resources\CategoryResource as CategoryResource;
use App\Service\RatingService;
use App\Http\Resources\RatingResource as RatingResource;
// use App\Service\CommentService;
// use App\Http\Resources\CommentResource as CommentResource;
// use App\Service\UserService;
// use App\Http\Resources\UserResource as UserResource;
use Cookie;
use Auth;

class ShowController extends Controller
{
    public $postService;
    public $categoryService;
    public $ratingService;
    public $commentService;
    public $userService;
    public function __construct(PostService $postService, CategoryService $categoryService,
        RatingService $ratingService)
    {

        $this->postService     = $postService;
        $this->categoryService = $categoryService;
        $this->ratingService   = $ratingService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->postService->getAll();
        $html='';
        foreach ($posts as $post) {
            $html .= '<div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                        <a href="/show/'.$post->id.'">
                            <img class="card-img-top" src="'.url('/').'/'.$post->image.'" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <h3 class="card-title">'.$post->title.'</h3>
                            <p class="card-text">'.$post->sapo.'</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/show/'.$post->id.'" class="btn btn-sm btn-outline-secondary">Read More</a>

                                </div>
                                <small class="text-muted">'.($post->created_at)->diffForHumans().'</small>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        if ($request->ajax()) {
            return $html;
        }
        return view( 'show.list', compact('posts') );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $post = $this->postService->getPostById($id);
        $rating = $this->ratingService->getRating($id,Auth::id());
        if ( $rating ) {
            $post->rating = $rating->number;
        }

        $categories = $this->categoryService->getAll();
        foreach ($categories as $category) {
            if ( $category->id === $post->category_id ) {
                $post->category_id = $category->name;
            }
        }

        // dem luot view co cookie
        $post = countView($post);
        return view('show.detail', [ 'post' => $post]);
    }
}
// dem luot view co cookie
// comment dua vao submit va rating bang ajax dua vao onchange
// load trang dua vao su kien scroll



