<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDatailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

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
}
