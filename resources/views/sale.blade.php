@extends('app')

@section('content')

    <main>
        <div class="container mt-5">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-tags-fill fs-3 me-2 sale-h"></i>
                <h2 class="mb-0">Prices like never before!</h2>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 mb-4 sale-card">
                        <div class="d-flex position-relative">
                            <a href="{{ route('showProduct', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->image_url) }}" class="img-fluid rounded-start" alt="{{ $product->name }}" style="width: 200px; height: auto;">
                            </a>
                            @if ($product->sale)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2 fs-6">SALE</span>
                            @endif
                            <div class="ms-4">
                                <h5 class="text-start">{{ $product->name }}</h5>
                                <p class="text-muted">{{ $product->description }}</p>
                                <p class="fw-bold">Price: <span class="text-danger">{{ number_format($product->price, 2) }}€</span></p>
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

@endsection
