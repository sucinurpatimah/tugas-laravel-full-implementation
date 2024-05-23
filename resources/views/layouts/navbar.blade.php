<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid" style="margin-left: 30px;">
            <a class="navbar-brand" href="https://dashboard.amandemy.co.id/">
                <img src="https://amandemy.co.id/images/amandemy-logo.png" alt="Logo" style="width: 150px;">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="d-flex ms-auto align-items-center" style="margin-right: 30px;">
                    @auth
                        <a class="nav-link me-3 fw-bold" href="{{ route('index') }}">HOME</a>
                        <a class="nav-link me-3 fw-bold" href="{{ route('products.index') }}">PRODUCTS</a>
                        @if (Auth::user()->roles[0]->name == 'admin')
                            <a class="nav-link me-3 fw-bold" href="{{ route('dashboard.admin.index') }}">MANAGE PRODUCT</a>
                        @endif
                        <div class="dropdown">
                            <button class="btn fw-bold bg-info dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </li>
                            </ul>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="nav-link me-3 fw-bold" href="{{ route('index') }}">HOME</a>
                        <a class="nav-link me-3 fw-bold" href="{{ route('products.index') }}">PRODUCTS</a>
                        <button class="btn fw-bold bg-info" type="button"
                            onclick="location.href='{{ route('login') }}'">LOGIN</button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
