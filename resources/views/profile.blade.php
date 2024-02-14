@extends('layouts.layout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <!-- Sidebar -->
      <div class="card">
        <div class="card-body text-center">
          <img src="profile-picture.jpg" alt="Profile Picture" class="profile-picture mb-3">
          <h5 class="card-title">John Doe</h5>
          <p class="card-text">Software Engineer</p>
          <p class="card-text">Location: New York, USA</p>
          <!-- Add more user information as needed -->
        </div>
      </div>
      <!-- Add more sidebar sections as needed -->
    </div>
    <div class="col-md-9">
      <!-- Main content -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">About</h5>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor nisl at ipsum venenatis, eget varius neque consectetur. Fusce mattis sapien sed lorem malesuada, et facilisis libero dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam vehicula libero eget sem maximus, id vestibulum erat mattis. In vehicula, ligula a vestibulum aliquam, mauris risus pharetra nulla, a pharetra nisl mi et felis.</p>
          <!-- Add more sections such as education, experience, skills, etc. -->
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


@endsection
