<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
       $posts=Post::select(
           "id",
           "title",
           "description",
           DB::raw("(Select url from images where post_id=posts.id)")
       )->get();


        return view('posts.index',compact('posts'));
    }

    public function add()
    {

        return view('posts.create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'description' => 'nullable|string',
        ]);

        $addPost = new Post();
        $addPost->title = $request->title;
        $addPost->description = $request->description;

        $addPost->save();

        $addImage = new Image();

        $image = $request->file('image');
        $image = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($image->store('public/project')));
        $addImage->url = $image;

        $addImage->post_id=$addPost->id;

        $addImage->save();

        return response()->json(['status'=>'success']);
    }

    public  function  delete(Request $request){

        $post=Post::find($request->id);
        $post->delete();
        return response()->json(['status'=>'success']);

    }


    public function  edit($id){
        $posts = Post::where("id" ,$id)->first();
        $image=Image::where("post_id",$id)->first();
        return view('posts.edit',compact('posts','image','id'));
    }

    public  function update(Request $request)
    {
        $addPost = Post::where("id",$request->id)->first();
        $addPost->title = $request->title;
        $addPost->description = $request->description;

        $addPost->save();

        $addImage = Image::where("post_id",$request->id)->first();

        $image = $request->file('image');
        $image = str_replace(['public', 'http:'], ['storage', App::environment() == 'projection' ? 'https:' : 'http:'], asset($image->store('public/project')));
        $addImage->url = $image;

        $addImage->save();
        return response()->json(['status'=>'success']);


    }
}
