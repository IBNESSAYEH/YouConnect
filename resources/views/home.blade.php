@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title align-self-center">{{ Auth::user()->name }}</h5>
                    <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile Picture"
                        class="profile-picture mb-3 align-self-center"
                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
                    <p class="card-text">Followers: </p>
                    <p class="card-text">Following: </p>
                    <a href="#" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Connections</h5>
                    <p class="card-text">You have X connections</p>
                    <ul class="list-group">
                        @forelse ($users as $user)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div>
                                <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile Picture"
                                    class="profile-picture mr-3"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                <p>{{ $user->name }}</p>
                            </div>
                            <form method="POST" action="{{ route('followers.store') }}">
                                @csrf
                                <input type="hidden" name="receiver" value="1"> <!-- Replace "1" with the actual receiver ID -->
                                <button type="submit" class="btn btn-sm btn-outline-success">Follow</button>
                            </form>
                            <a href="http://127.0.0.1:8000/chatify/{{ $user->id }}"  class="btn btn-sm btn-outline-success">send message</a>
                        </li>
                        @empty
                        <li class="list-group-item">No connections</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <!-- Add more sidebar sections as needed -->
        </div>
        <!-- Main content -->
        <div class="col-md-6">
            <!-- Create Post -->
            <div class="card mb-3">
                <div class="card-body">
                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="content" placeholder="What's on your mind?"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image_path" class="form-control-file">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
       
            @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-header d-flex align-items-center">
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('posts.edit',['post'=>$post->id]) }}" class="btn btn-dark">
                            <i class="fa-solid fa-pen-to-square" style="margin-left: 5px;"></i>
                        </a>
                    </div>


                    <h5 class="card-title">{{ $post->user->name }}</h5>
                    <p class="card-text">{{ $post->content }}</p>
                    @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-100">
                    @endif
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <form action="{{ route('likes.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" name="submit" class="btn btn-outline-primary">
                                <i class="far fa-heart"></i> Like
                            </button>
                        </form>
                        <form action="{{ route('dislike') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" name="submit" class="btn btn-outline-danger">
                                <i class="fas fa-heart"></i> dislike
                            </button>
                        </form>
                    </div>
                    <form action="{{route('commantaire.store')}}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <input type="hidden" value="{{$post->id}}" name="postId">
                            <input
                                class="w-100 h-10 bg-slate-50 rounded-lg px-5 text-slate-900 focus:outline focus:outline-2 focus:outline-indigo-500"
                                type="text" name="comment" placeholder="Quelque chose à rajouter ? 🎉"
                                autocomplete="off">
                            <button
                                class="ml-2 w-12 flex justify-center items-center shrink-0 bg-indigo-700 rounded-full text-indigo-50" name="submit">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        @error('comment')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </form>
                    <div class="space-y-8">

                        @foreach($post->comments as $comment)
                        <div class="flex bg-slate-50 p-6 rounded-lg">
                        <img class="w-10 h-10 sm:w-12 sm:h-12 object-cover mt-2" style="border-radius: 50%;" src="{{ Gravatar::get($comment->user->email) }}" alt="Image de profil de {{ $comment->user->name }}">
                                <div class="ml-4 flex flex-col">
                                    <div class="flex flex-col sm:flex-row sm:items-center">
                                        <h2 class="font-bold text-slate-900 text-2xl">{{ $comment->user->name }}</h2>
                                    </div>
                                    <p class="mt-4 text-slate-800 sm:leading-loose">{{ $comment->content }}</p>
                                    <form action="{{route('commantaire.destroy', $comment->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        @endforeach
        <!-- Right sidebar -->
        <div class="col-md-3">
            <!-- Right sidebar content goes here -->
        </div>
    </div>
</div>
@endsection