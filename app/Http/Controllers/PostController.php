<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\User;
use App\Post;

class PostController extends Controller
{
    //------------this is the index function to view all posts 
    public function index(){

            $posts=Post::paginate(3);
           
           return view('posts.index',[ 'posts'=>$posts ,]);
    }
     
    //-------------this is for the create post button 
    public function create(){
        
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }

    //---------------this to update post details and store it again
    public function update(Post $post){
         $request=request();
        // dd($request->user_id);
        $exist=User::find($request->user_id);
        $validation=$request->validate(['title'=>'min:3|unique:posts,title,'.$post->id,
                                        'description'=>'min:10']);
        // dd($validation);
        if($exist){
            $post->update($request->all());
            return redirect()->route('posts.index');
        }
          return redirect()->back()->withErrors(['user ID is not valid']);
    }
        
    //--------------this function to delete post from database
    public function destroy(Request $request,Post $post){
        
        $post->delete($request->id);
        return redirect()->route('posts.index');
      
    }

   //-----------------this to store element to database
    public function store(PostRequest $request){

          // $request=request();
          $post=new Post();
         // dd($post);
          $exist=User::find($request->user_id);
          if($exist){
           Post::create(['title'=>$request->title,
                        'description'=>$request->description,
                         'user_id'=>$request->user_id,
                         ]);
                    return redirect()->route('posts.index');

          }
          else{
              return redirect()->back()->withErrors(['user ID is not valid']);
          }
    }

  //------------------is function to display details of certain post
    public function show(){

           $request=request();
           $postId=$request->post;
           $post=Post::find($postId);
           $user=User::find($post->user_id);
           return view('posts.show',['post'=>$post,'owner'=>$user]);
    }

    //----------------this to view wanted to edit post 
    public function edit($id){
       
        $post=Post::find($id);
        $user=User::find($post->user_id);
        $users=User::all();
        return view('posts.edit',['post'=>$post,'user'=>$user,'users'=>$users]);
    }
}
