<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $requestData =$request->all();
        if($request->hasFile('image')) {
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $requestData['image'] = '/images/'.$fileName;
        }
        return $post->update($requestData);
    }
    public function destroy(Post $post)
    {
        return $post->delete();
    }

    public function import_file(){
        return view('layouts.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xls,xlsx,csv,pdf'
        ]);
        $rows = [];
        $path = $request->file('import')->getRealPath();
        $records = array_map('str_getcsv', file($path));
        if(!count($records) > 0){
            return 'Error';
        }
        $fields = array_map('strtolower', $records[0]);
        array_shift($records);

        foreach ($records as $record) {
            if(count($fields) != count($record)){
                return redirect('/')->with('error', 'Csv upload invalid data');
            }
            $record = array_map("html_entity_decode", $record);
            $record = array_combine($fields, $record);
            $rows[] = $record;
        }
        foreach($rows as $row){
            
            Post::updateOrCreate([
                'title' => $row['title'],
                'description' => $row['description'],
                'image' => $row['image']
            ]);
        }
        return redirect('/api/posts');   
      
    }

    public function export()
    {
        return Excel::download(new PostsExport, 'posts.csv');
    }
}
