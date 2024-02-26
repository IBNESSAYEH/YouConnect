<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">YouConnecte</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('profile') }}">Profile</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" id="search_title">
                </form>
            </div>
        </div>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="http://127.0.0.1:8000/chatify">
                <div class=" d-flex align-items-center "><i class="fa-solid fa-bell me-1"></i>

                        <p class="btn btn-danger  p-0 rounded-circle m-0">{{ $messagesCount }}</p>

                </div>
            </a>
        </li>
    </nav>
    <div id="searchResults">
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    var searchTitleInput = document.getElementById("search_title");
    var searchResultContainer = document.getElementById("searchResults");

    searchTitleInput.addEventListener("keyup", function () {
        var title = this.value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/search/?title_s=' + encodeURIComponent(title), true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                searchResultContainer.innerHTML = xhr.responseText;
            } else {
                console.error("Error during search:", xhr.statusText);
            }
        };
        xhr.onerror = function () {
            console.error("Error during search:", xhr.statusText);
        };
        xhr.send();
    });
});

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
