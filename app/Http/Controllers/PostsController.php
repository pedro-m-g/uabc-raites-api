<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePost;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => 'feed'
        ]);
    }

    public function feed()
    {
        return Post::feed();
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return $request->user()->posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePost $request)
    {
        $post = Post::make($request->validated());
        auth()->user()->posts()->save($post);
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

}
