<?php

namespace App\Http\Controllers\Api;
use App\Htpp\Requests\PostRequest;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    //-----------------this to send all posts
    public function index(){
       
     return (PostResource::collection(Post::all()));
    }

    //----------------------this to view content of one post
    public function show(Request $request){
    $post=Post::find($request->post);
    if($post){
     return new PostResource($post);  
    }
    else{
        return ('this post not exist');
    }
}
    //-----------------------this to store new post
    public function store(Request $request){
        $exist=User::find($request->user_id);
        if($exist){
        $validation=$request->validate(['title'=>'unique:posts|min:3',
        'description'=>'min:10',]);
        $post=Post::create(['title'=>$request->title,
        'description'=>$request->description,
         'user_id'=>$request->user_id,
                      ]);
        return new PostResource($post);
        }
        else{
            return ('error with validation title must be at least 3 and desc 10');
        }
    }
}
