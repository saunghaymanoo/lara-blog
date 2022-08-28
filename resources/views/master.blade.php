<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    @stack('style')
    <!-- Scripts -->
    @vite(['resources/sass/theme.scss', 'resources/js/theme.js'])
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{route('page.index')}}">Laravel Posts</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('page.index')}}">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
                        <div class="dropdown-menu">
                            @foreach(App\Models\Category::all() as $category)
                            <a class="dropdown-item" href="{{route('page.postbycategory',$post->category->slug)}}">{{$category->title}}</a>
                            @endforeach

                        </div>
                    </li>

                    @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('post.index')}}">
                                Home
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('login')}}">Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('register')}}">
                            Register
                        </a>
                    </li>
                    @endauth

                    <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </li> -->

                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="../../node_modules/venobox/dist/venobox.js"></script>
    <script>
        new VenoBox({
            selector: ".venobox"
        });
    </script>
</body>

</html>