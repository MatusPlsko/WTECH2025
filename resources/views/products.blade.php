@extends('app')
@section('content')



    <div class="products-container">
        {{-- SIDEBAR --}}
        <div class="categories-sidebar">
            <h3>CATEGORIES</h3>
            <ul class="list-unstyled">
                <li>
                    <a
                        href="{{ route('products.index') }}"
                        class="{{ is_null($currentCategory) ? 'fw-bold' : '' }}"
                    >All Products</a>
                </li>
                @foreach($categories as $cat)
                    <li>
                        <a
                            href="{{ route('products.filter', ['category' => $cat->id]) }}"
                            class="{{ $currentCategory == $cat->id ? 'fw-bold' : '' }}"
                        >{{ $cat->name }}</a>
                    </li>
                @endforeach
            </ul>

            <h3 class="mt-4">PRICE RANGE</h3>

            <form method="GET" action="{{ route('products.index') }}">
                {{-- zachovaj ostatné filtre --}}
                <input type="hidden" name="category" value="{{ $currentCategory }}">
                <input type="hidden" name="q"        value="{{ $term }}">

                {{-- Min Price --}}
                <div class="mb-3">
                    <label class="form-label">Min Price (€)</label>
                    <input
                        type="number"
                        name="min_price"
                        value="{{ $minPrice ?? '' }}"
                        step="0.01"
                        class="form-control form-control-sm"
                        placeholder="0.00"
                    >
                </div>

                {{-- Max Price --}}
                <div class="mb-3">
                    <label class="form-label">Max Price (€)</label>
                    <input
                        type="number"
                        name="max_price"
                        value="{{ $maxPrice ?? '' }}"
                        step="0.01"
                        class="form-control form-control-sm"
                        placeholder="100.00"
                    >
                </div>
                <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
            </form>





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

        {{-- HLAVNÁ ČASŤ S PRODUKTMI --}}
        <div class="products-section">
            <div class="d-flex align-items-center">
                <h3 class="h3 mb-4 text-secondary fw-bold">Featured Products</h3>
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
                @if($products->count())
                    @foreach($products as $p)
                        <div class="card">
                            @if($p->images->first())
                                <a href="{{ route('showProduct', $p->id) }}">
                                    <img src="{{ asset('storage/'.$p->images->first()->path) }}"
                                         class="card-img-top"
                                         alt="{{ $p->name }}">
                                </a>
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image fs-1 text-muted"></i>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $p->name }}</h5>
                                <p class="card-text">€{{ number_format($p->price, 2) }}</p>
                            </div>

                            <form method="POST" action="{{ route('cart.add', $p->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No products</p>
                @endif
            </div>

            <div class="pagination-section">
                {{ $products->links() }}
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
