<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDatailResource;

class PostController extends Controller
{
   public function index(){
        $post=Post::all();
        //  return response()->json(['data'=>$post]);
        return PostResource::collection($post);
   }
   public function show($id){
    $posts=Post::with('writer:id,username')->findOrfail($id);
    return  new PostResource($posts);

   }
   public function show2($id){
      $posts=Post::findOrfail($id);
      return    new PostDatailResource($posts);
     }


     public function store(Request $request){
          $validate=$request->validate([
               'title' => 'required|max:255',
               'new_conent' => 'required'
          ]);
          // return response()->json("ok in the store");
          $request['author']=Auth::user()->id;
          $post=Post::create($request->all());
          return    new PostDatailResource($post->loadMissing('writer:id,username')); 
     }

}
