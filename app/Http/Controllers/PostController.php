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
         
          $validated=$request->validate([
               'title' => 'required|max:255',
               'new_content' => 'required',
          ]);
          
          // return response()->json("ok in the store");
          // $request['author']=Auth::user()->id;
          $request['author']=Auth::user()->id;
          $post=Post::create($request->all());
          
          return    new PostDatailResource($post->loadMissing('writer:id,username')); 
     }
     public function update(Request $request,$id){
        $validated=$request->validate([
          'title' => 'required|max:255',
          'new_content' => 'required',
     ]);

     $post=Post::findOrFail($id);
     $post->update($request->all());
     return    new PostDatailResource($post->loadMissing('writer:id,username')); 
     }


     public function destroy($id){
          $post=Post::findOrFail($id);
          $post->delete();

          return    new PostDatailResource($post->loadMissing('writer:id,username')); 
     }

}
