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
                            class="profile-picture mb-3 align-self-center" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">
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
                                            class="profile-picture mr-3" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                        <p>{{ $user->name }}</p>
                                    </div>
                                    <button class="btn btn-sm btn-outline-success">Connect</button>
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
                <!-- News Feed -->
                @foreach ($posts as $post)
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
                                        <i class="fas fa-heart"></i> Unlike
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Right sidebar -->
            <div class="col-md-3">
                <!-- Right sidebar content goes here -->
            </div>
        </div>
    </div>
@endsection
