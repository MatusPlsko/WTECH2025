<header>
    <nav class="navbar navbar-upper">
        <div class="container-fluid">
            <a id="main" class="navbar-brand" href="{{route('home')}}"><b>TECH</b>nutrition</a>
            <div class="justify-content-center text-center">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn p-0" type="submit"><i class="bi bi-search fs-3"></i></button>
                </form>
            </div>
            <div class="d-flex align-items-center gap-2 ms-auto">
                <div class="dropdown">
                    <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill fs-3"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="width: 250px;">
                        @auth
                            <h5 class="text-center">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name}}
                            </h5>

                            @if(Auth::user()->is_admin)
                                <div class="d-grid gap-2 my-2">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Admin panel</a>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                                </div>
                            </form>
                        @else
                            <h5 class="text-center">Login</h5>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-2">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
                                </div>
                            </form>
                        @endauth
                    </div>
                </div>



                <button class="btn p-0" onclick="window.location.href='{{ route('cart') }}'">
                    <i class="bi bi-cart fs-3"></i>
                </button>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-bottom">
        <div class="container-fluid justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-500 justify-content-center" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ALL PRODUCTS
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('products')}}">Protein</a></li>
                            <li><a class="dropdown-item" href="{{route('products')}}">Amino Acids</a></li>
                            <li><a class="dropdown-item" href="{{route('products')}}">Creatine</a></li>
                            <li><a class="dropdown-item" href="{{route('products')}}">Pre-workout</a></li>
                            <li><a class="dropdown-item" href="{{route('products')}}">Weight Loss</a></li>
                            <li><a class="dropdown-item" href="{{route('products')}}">Vitamins</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('sale')}}">SALE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('news')}}">NEWS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">ABOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
