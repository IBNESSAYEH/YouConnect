@extends('layouts.layout')
@section('content')

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="card">
        <div class="card-body d-flex flex-column ">
          <h5 class="card-title align-self-center">{{ Auth::user()->name }}</h5>
          <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile Picture" class="profile-picture mb-3 align-self-center">
          <p class="card-text">followers : </p>
          <p class="card-text">following : </p>
          <a href="#" class="btn btn-primary">Edit Profile</a>
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-body">
          <h5 class="card-title">Connections</h5>
          <p class="card-text">You have X connections</p>
          <ul  style="list-style : none">
            @forelse ( $users as $user)

            <li class="d-flex gap-2 mb-2"> <img src="{{ asset('storage/' .  $user->profile ) }}" alt="Profile Picture" class="profile-picture mb-3 " style="width : 15% ; height : 20%; ">
                <p>{{ $user->name }}</p>
                <div class="btn btn-success">follow</div>
                <div class="btn btn-danger">unfollow</div>
            </li>
            @empty

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

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">News Feed</h5>
          <div class="card mb-3">
            <div class="card-body">
              <h6 class="card-subtitle mb-2 text-muted">{{ $post->user->name }}</h6>
              <p class="card-text">{{ $post->content }}</p>


              @if ($post->image_path)
              <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" class="w-100">
          @endif
            </div>
          </div>
          <!-- Add more posts as needed -->
        </div>
        <div class="card-footer">

            <form action="{{ route('likes.store') }}" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" >
                <button type="submit" name="submit"  class="btn btn-primary"><i class="fa-regular fa-heart"></i></button>
            </form>
            <form action="{{ route('dislike') }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="post_id" value="{{ $post->id }}" >
                <button type="submit" name="submit"  class="btn btn-danger"><i class="fa-solid fa-heart"></i></button>

            </form>
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
