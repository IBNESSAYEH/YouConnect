@extends('layouts.layout')
@section('content')
<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="{{ route("signup") }}" method="POST">
            @csrf

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">Register</p>
            </div>
            <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Name :</label>
                <input type="text" name="name" id="form3Example4" class="form-control form-control-lg"
                  placeholder="Enter your name" />
              </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Email address :</label>
              <input type="email" name="email" id="form3Example3" class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Password :</label>
                <input type="password" name="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" />
            </div>

            <!-- Confirm Password input -->
            <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Confirm Password :</label>
                <input type="password" name="password_confirmation" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Confirm password" />
            </div>


        <input type="submit" name="submit" class="btn btn-primary" value="register">
          </form>
        </div>
      </div>
    </div>

  </section>
@endsection
