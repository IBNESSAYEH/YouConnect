@extends('layouts.layout')
@section('content')

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Your Profile</h5>
          <img src="profile-picture.jpg" alt="Profile Picture" class="profile-picture mb-3">
          <p class="card-text">Your Name</p>
          <p class="card-text">Your Job Title</p>
          <a href="#" class="btn btn-primary">Edit Profile</a>
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-body">
          <h5 class="card-title">Connections</h5>
          <p class="card-text">You have X connections</p>
          <a href="#" class="btn btn-outline-primary">View Connections</a>
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

              {{ Auth::id() }}
              @if ($post->image_path)
              <img src="{{ asset('storage/images/' . $post->image_path) }}" alt="Post Image">
          @endif
            </div>
          </div>
          <!-- Add more posts as needed -->
        </div>
        <div class="card-footer">
       
            <form action="{{ route('likes.store') }}" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" >
                <button type="submit" name="submit"  class="btn btn-primary">like</button>
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
