<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  @stack('scripts')  <!-- For page-specific scripts -->

</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('icons/celebrate.png') }}" class="me-2" width="40" height="40" alt="PostVibe Logo">
                        <h2 class="text-header m-0">PostVibe</h2>
                    </div>
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Navigation -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-compass"></i> Explore
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-bell"></i> Notifications
                            </a>
                        </li>
                    </ul>

                <!-- Search Form -->
<form class="d-none d-md-flex mx-3" action="{{ route('search') }}" method="GET">
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="bi bi-search"></i>
        </span>
        <input type="search" class="form-control bg-light border-start-0" placeholder="Search PostVibe" name="q" id="search-input">
        <!-- Search Button -->
        <button type="submit" class="btn btn-secondary">Search</button>
    </div>
</form>


                    <!-- Right Navigation -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-chat-dots"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                               <img src="{{ Auth::user()->profile->image ? asset(Auth::user()->profile->image) : asset('images/Blank-Profile-Picture.webp') }}"
     class="rounded-circle me-2"
     style="width: 30px; height: 30px;"
     alt="Profile Picture">
                                    <span>{{ Auth::user()->username }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow">
                                    <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id) }}">
                                        <i class="bi bi-person me-2"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear me-2"></i> Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <div id="app" class="d-flex flex-column min-vh-100">

        <!-- Main Content -->
        <main class="py-4 flex-grow-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-top mt-auto">
            <div class="container py-4">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('icons/celebrate.png') }}" width="32" height="32" class="me-2" alt="PostVibe Logo">
                            <h5 class="m-0">PostVibe</h5>
                        </div>
                        <p class="text-muted">Connect, Share, and Inspire with PostVibe - Your Social Journey Starts Here.</p>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-muted"><i class="bi bi-facebook fs-5"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-twitter fs-5"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-instagram fs-5"></i></a>
                            <a href="#" class="text-muted"><i class="bi bi-linkedin fs-5"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h6 class="mb-3">Company</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#" class="text-muted text-decoration-none">About Us</a></li>
                            <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Careers</a></li>
                            <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Press</a></li>
                            <li><a href="#" class="text-muted text-decoration-none">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h6 class="mb-3">Resources</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Help Center</a></li>
                            <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Community</a></li>
                            <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Developers</a></li>
                            <li><a href="#" class="text-muted text-decoration-none">Status</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h6 class="mb-3">Stay Updated</h6>
                        <p class="text-muted mb-3">Subscribe to our newsletter for updates and news.</p>
                        <form class="mb-3">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Enter your email">
                                <button class="btn btn-primary" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="text-muted mb-0">&copy; {{ date('Y') }} PostVibe. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted text-decoration-none">Terms</a>
                            </li>
                            <li class="list-inline-item">
                                <span class="text-muted">·</span>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted text-decoration-none">Privacy</a>
                            </li>
                            <li class="list-inline-item">
                                <span class="text-muted">·</span>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted text-decoration-none">Cookies</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
