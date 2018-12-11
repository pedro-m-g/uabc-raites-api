<?php

namespace App\Http\Controllers;

use App\Post;
use App\Trip;
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

    public function trip(Post $post, Request $request)
    {
        $request->validate([
            'place' => 'required'
        ]);
        $trip = false;
        $exclude = collect($post->passengers())->pluck('id')->toArray();
        $exclude[] = $post->user->id;
        $user = auth()->user();
        if ($post->available_seats > 0 && array_search($user->id, $exclude) === false) {
            \DB::transaction(function () use (&$trip, $user, $post, $request) {
                $trip = Trip::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'place'   => $request->place
                ]);
                $post->available_seats--;
                $post->save();
            });
            return $trip;
        } else {
            return [ 'error' => 'El viaje no está disponible' ];
        }
    }

    public function rate(Trip $trip, Request $request)
    {
        $request->validate([
            'rating' => 'required|number|min:1|max:5'
        ]);
        $trip->rating = $request->rating;
        $trip->save();
    }

    public function passengers(Post $post)
    {
        return $post->passengers();
    }

}
