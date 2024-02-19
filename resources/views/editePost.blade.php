<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edite page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <form action="{{route('posts.update', ['post'=>$post->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Content:</label>
            <input type="text" class="form-control" id="title" name="content" value="{{ old("content", $post->content ?? null) }}" >
        </div>
        <div class="form-group">
            <label for="prix">Image:</label>
            <input type="file" class="form-control" id="prix" name="image_path" value="{{ old("image_path", $post->image_path ?? null) }}" >
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
