<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' =>'required|email',
            'password' =>'required',
        ]);
    
    $user=User::where('email',$request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken('user log in')->plainTextToken;  

    }
    // log out user
    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

    }
    public function me(Request $request){
        $user=Auth::user();
        $post=Post::where('user',$user->id);

        return response()->json(Auth::user());


    }



}
