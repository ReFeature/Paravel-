<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    public function __construct () {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    public function index () {
        return PostResource::collection(Post::all());
    }
    
    public function store (StorePostRequest $request) {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user()->associate($request->user());
        $post->save();
        return new PostResource($post);
    }
    
    public function show (Post $post) {
        return new PostResource($post);
    }
    
    public function update (UpdatePostRequest $request, Post $post) {
        $this->authorize('update', $post);
        $post->title = $request->input('title', $post->title);
        $post->body = $request->input('body', $post->body);
        $post->save();
        return new PostResource($post);
    }
    
    public function destroy (Post $post) {
        $post->delete();
        return response(null, 204);
    }
}
