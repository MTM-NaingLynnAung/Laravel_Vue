<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        if(request('search')){
           return Post::where('title', 'like', '%'. request('search'). '%')
                    ->orderBy('id', 'desc')->get();
        }
        return Post::orderBy('id','desc')->get();
    }
    public function show(Post $post)
    {
        return $post;
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        return Post::create($request->only('title', 'description'));
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        return $post->update($request->only('title','description'));
    }
    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
