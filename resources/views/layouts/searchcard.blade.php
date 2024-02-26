@foreach ($users as $user)
<div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{ $user->name }}</h5>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
@endforeach
