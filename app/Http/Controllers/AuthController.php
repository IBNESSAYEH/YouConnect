<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(){
       return view("Auth.Register");
    }
    public function login(){
        return view("Auth.Login");
    }
    public function signup(Request $request){



      // Validate the form data
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:8|confirmed',
        'profile' => 'image|mimes:jpeg,png,jpg,gif|max:2000000',
    ]);

    if ($request->hasFile('profile')) {
        $imagePath = $request->file('profile')->store('images', 'public');
        $validatedData['profile'] = $imagePath;
    }
    // Create a new user
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
        'profile' => $validatedData['profile'],
    ]);


    if ($user) {

        return redirect()->route('login');
    } else {
        return redirect()->route('register');
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

        // Pass the users data to the view
        return view('layouts.searchcard')->with(['users' => $users]);
    }

}
