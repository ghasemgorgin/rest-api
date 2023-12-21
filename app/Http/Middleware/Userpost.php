<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Userpost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $currentUser=Auth::user();
        $currentUser=$currentUser;
        $post=Post::findOrFail($request->id);
        $post=$post->author;
        if($post!=$currentUser->id){
            dd("kiiiit");
            return response()->json(['message' =>'data not found'],404);
        }
        // return response()->json($currentUser);
        return $next($request);
    }
}
