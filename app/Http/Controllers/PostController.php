<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'content' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2000000',
        ]);

        // Handle file upload
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $validatedData['image_path'] = $imagePath;
        }


        $validatedData['user_id'] = auth()->user()->id;


        // Create a new post
        $post = Post::create($validatedData);

        // Redirect or perform any other actions after successful post creation
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $post = Post::findOrFail($post);
        return view("editePost", ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'content' => 'required',
        'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2000000',
    ]);

    // Retrieve the post
    $post = Post::findOrFail($id);

    // Check if the authenticated user owns the post
    if ($post->user_id !== auth()->user()->id) {
        return back()->with('error', 'You are not authorized to update this post.');
    }

    // Handle file upload
    if ($request->hasFile('image_path')) {
        $imagePath = $request->file('image_path')->store('images', 'public');
        $validatedData['image_path'] = $imagePath;
    }

    // Update the post
    $post->update($validatedData);

    // Redirect or perform any other actions after successful post update
    return redirect()->route('home');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('home');
    }
}
