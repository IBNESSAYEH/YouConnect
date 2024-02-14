<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $posts = Post::all();
        return view('home',['posts' => $posts]);
    }
    public function profile(){
        return view('profile');
    }
}
