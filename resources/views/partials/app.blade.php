<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Uniscor' }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">
    <section class="menu menu2">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <strong class="text-danger">U</strong>niscor
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @if (Auth::user()->role == 'admin')
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('universities.list') }}">Universities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('universities.rankings') }}">Rankings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('welcome') }}">About</a>
                            </li>
                            @endif

                    </ul>
                    <div class="navbar-nav">
                        @if (Auth::check())
                            @if (Auth::user()->image != '')
                                <a class="nav-link" href="{{ route('auth.profileView') }}">
                                    <img src="{{ asset('storage/uploads/profile/thumb/'.Auth::user()->image) }}" alt="avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                                </a>
                            @else
                                <a class="nav-link" href="{{ route('auth.profileView') }}">
                                    <img src="{{ asset('images/artist.png') }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                                </a>
                            @endif
                        @else
                            <a class="btn btn-primary me-2" href="{{ route('auth.loginForm') }}">Log In</a>
                            <a class="btn btn-danger" href="{{ route('auth.registerForm') }}">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </section>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
