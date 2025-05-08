@extends('app')
@section('content')



    <div class="products-container">
        <div class="categories-sidebar">
            <h3>CATEGORIES</h3>
            <ul class="list-unstyled">
                <li><a href="products.html">Proteins</a></li>
                <li><a href="products.html">Amino Acids</a></li>
                <li><a href="products.html">Creatine</a></li>
                <li><a href="products.html">Pre-workout</a></li>
                <li><a href="products.html">Post-workout</a></li>
                <li><a href="products.html">Weight Loss</a></li>
                <li><a href="products.html">Vitamins</a></li>
            </ul>

            <h3 class="mt-4">PRICE RANGE</h3>
            <div class="px-2">
                <div class="d-flex justify-content-between mb-2">
                    <span class="small">€0</span>
                    <span class="small">€100</span>
                </div>
                <input type="range" class="form-range mb-3" min="0" max="100" value="100">
                <div class="d-flex gap-2 mb-3">
                    <input type="number" class="form-control form-control-sm" placeholder="Min" min="0">
                    <input type="number" class="form-control form-control-sm" placeholder="Max" min="0">
                </div>
            </div>

            <h3 class="mt-4">RATING</h3>
            <ul class="list-unstyled px-2">
                <li class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rating5">
                        <label class="form-check-label text-white" for="rating5">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </label>
                    </div>
                </li>
                <li class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rating4">
                        <label class="form-check-label text-white" for="rating4">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            & up
                        </label>
                    </div>
                </li>
                <li class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rating3">
                        <label class="form-check-label text-white" for="rating3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            <i class="bi bi-star text-warning"></i>
                            & up
                        </label>
                    </div>
                </li>
            </ul>
        </div>

        <div class="products-section">
            <div class="d-flex align-items-center">
                <h3 class="h3 mb-4 text-secondary fw-bold">     Featured Products</h3>
                <div class="ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-filter dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Filter By
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                            <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                            <li><a class="dropdown-item" href="#">Newest First</a></li>
                            <li><a class="dropdown-item" href="#">Most Popular</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="product-grid">

                @foreach($products as $p)
                    <div class="card">

                            {{-- Image --}}
                            @if($p->images->first())
                                <a href="">
                                    <img src="{{ asset('storage/'.$p->images->first()->path) }}"
                                         class="card-img-top"

                                         alt="{{ $p->name }}">
                                </a>
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image fs-1 text-muted"></i>
                                </div>
                            @endif

                            {{-- Name & Price --}}
                            <div class="card-body">
                                <h5 class="card-title">{{ $p->name }}</h5>
                                <p class="card-text">€{{ number_format($p->price, 2) }}</p>
                            </div>

                            {{-- Add to Cart Button --}}
                        <a href="" class="btn btn-primary">Add to Cart</a>

                    </div>
                @endforeach



            <div class="pagination-section">
                <nav aria-label="Product navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center text-white py-4">
            <div class="footer-content">
                <p>&copy; 2025 TECHnutrition. All rights reserved.</p>

                <p>Kontakt: info@wtech.com</p>
            </div>
        </div>
    </footer>
@endsection
