<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userAuthenticated ;
    public function __construct(AuthService $authService){
        $this->userAuthenticated = $authService;
    }

    public function register(){
       return view("Auth.Register");
    }
    public function login(){
        return view("Auth.Login");
    }
    public function signup(Request $request){
        $user = $this->userAuthenticated->register($request);


    if ($user === true) {

        return redirect()->route('login');
    } else {

        return redirect()->route('register')->with('user', $user);
    }

    }
    public function signin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->route('home');
        } else {

            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login'); // Redirect to your login page after logout
    }
    public function search(Request $request)
    {
        $keyword = $request->input('title_s');

        if ($keyword === '') {
            // If the search keyword is empty, return all users or handle as needed
            $users = User::all();
        } else {
            // Search for users with names containing the keyword
            $users = User::where('name', 'like', '%' . $keyword . '%')->get();
        }

        // Return the view with the users data
        return view('layouts.searchcard', compact('users'));
    }
}
