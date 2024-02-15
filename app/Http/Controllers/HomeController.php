<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $posts = Post::with('user')->get();

        $users = User::all();


        return view('home',['posts' => $posts, 'users' => $users]);
    }
    public function profile(){
        return view('profile');
    }
}
