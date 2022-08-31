<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;

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
            'description' => 'required',
            'image' => 'nullable'
        ]);
        $requestData =$request->all();
        if($request->hasFile('image')){
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $requestData['image'] = '/images/'.$fileName;
        }else{
            $requestData['image'] = '/images/profile.png';
        }
        return Post::create($requestData);
    }

    public function edit(Post $post)
    {
       return view('posts.edit', compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        Log::alert("message");
        Log::alert($request);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $requestData =$request->all();
        $fileName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $fileName);
        $requestData['image'] = '/images/'.$fileName;
        
        return $post->update($requestData);
    }
    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
