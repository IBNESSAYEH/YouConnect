<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $posts = Post::with('user')->get();
        $likes = Like::with('user', 'post')->get();
   
        // $image = base64_decode($posts->image_path);
        // dd($image);
        return view('home',['posts' => $posts]);
    }
    public function profile(){
        return view('profile');
    }
}
