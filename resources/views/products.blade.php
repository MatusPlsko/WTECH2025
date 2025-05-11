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

            @if($errors->has('min_price') || $errors->has('max_price'))
                <div class="alert alert-warning">
                    @if($errors->has('min_price'))
                        <div>{{ $errors->first('min_price') }}</div>
                    @endif
                    @if($errors->has('max_price'))
                        <div>{{ $errors->first('max_price') }}</div>
                    @endif
                </div>
            @endif

            <form method="GET" action="{{ route('products.index') }}">
                {{-- zachovaj ostatné filtre --}}
                <input type="hidden" name="category" value="{{ $currentCategory }}">
                <input type="hidden" name="q" value="{{ request('q') }}">

                {{-- Min Price --}}
                <div class="mb-3">
                    <label class="form-label">Min Price (€)</label>
                    <input
                        type="number"
                        name="min_price"
                        value="{{ $minPrice ?? '' }}"
                        min="0"
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
                        min="0"
                        step="0.01"
                        class="form-control form-control-sm"
                        placeholder="100.00"
                    >
                </div>

                <h3 class="mt-4">BRAND</h3>
                @php
                    $allBrands = ['TechNutrition','BeamNutrition','ProteinTech','BioTech','Wsupplements'];
                    $selected = request('brands', []);
                @endphp
                <div class="mb-3 px-2">
                    @foreach($allBrands as $brand)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="brands[]"
                                id="brand_{{ $brand }}"
                                value="{{ $brand }}"
                                {{ in_array($brand, $selected) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="brand_{{ $brand }}">
                                {{ $brand }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
            </form>






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
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}"
                                >Price: Low to High</a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}"
                                >Price: High to Low</a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}"
                                >Newest First</a>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ request()->fullUrlWithQuery(['sort' => 'rating']) }}"
                                >Best rating</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="product-grid">
                @if($products->count())
                    @foreach($products as $p)
                        @if($p->stock_quantity > 0)
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
                        @endif
                    @endforeach
                @else
                    <p class="text-center">No products</p>
                @endif
            </div>

            <div class="mt-4 d-flex justify-content-between align-items-center">
                {{-- 1) text s rozsahom --}}
                <div class="text-secondary">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                </div>

                {{-- 2) jednoduché šípky --}}
                <nav aria-label="Product pagination">
                    <ul class="pagination mb-0">
                        {{-- Previous --}}
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a
                                class="page-link"
                                href="{{ $products->previousPageUrl() }}"
                                aria-label="Previous"
                            >
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Next --}}
                        <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                            <a
                                class="page-link"
                                href="{{ $products->nextPageUrl() }}"
                                aria-label="Next"
                            >
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
