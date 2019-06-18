<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use App\Service\PostService;
use App\Http\Resources\PostResource as PostResource;
use App\Service\CategoryService;
use App\Http\Resources\CategoryResource as CategoryResource;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{

    public $postService;
    public $categoryService;
    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getAll();
        return view( 'posts.list', compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $categories = $this->categoryService->getAll();

        foreach ($categories as $category) {
            $list[(string)$category->id] = $category->name;
        }

        $categories = $list;

        return view( 'posts.create', [ 'user_id' => $user_id, 'categories' => $categories ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $timestamp = Carbon::now()->timestamp;
        $id = $this->postService->getPostIdMax() + 1;

        if ($request->hasFile('image')) {
            $file = $request->image ;
            $path = $file->move('uploads', $file->getClientOriginalName());
            $data['image']       = $path;
        }
        $data['title']       = $request->title;
        $data['slug']        = $this->createSlug($request->title, $id, $timestamp);
        $data['sapo']        = $request->sapo;
        $data['content']     = $request->content;
        $data['category_id'] = $request->category_id;
        $data['user_id']     = $request->user_id;
        $this->postService->createPost($data);
        return redirect( '/posts' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        $post = $this->postService->getPostById($id);
        $categories = $this->categoryService->getAll();
        foreach ($categories as $category) {
            $list[$category->id] = $category->name;
        }
        $categories = $list;
        return view('posts.edit', ['categories' => $categories, 'post' => $post ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = $this->postService->getPostById($id);
        if(!$post) abort('404');
        if ($request->hasFile('image')) {
            $file = $request->image ;
            $path = $file->move('uploads', $file->getClientOriginalName());
            $post->image       = $path;
        }
        $post->title       = $request->title;
        $post->sapo        = $request->sapo;
        $post->content     = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id     = $request->user_id;
        $post->save();
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return redirect('/posts');
    }

    public function createSlug($title, $id, $createAt)
    {
        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'd'=>'đ|Đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $title = preg_replace("/($uni)/i", $nonUnicode, $title);
        }
        $title = str_replace(' ','-',$title);
        $slug = $title.'-'.$id.'-'.$createAt;
        return $slug;
    }
}
