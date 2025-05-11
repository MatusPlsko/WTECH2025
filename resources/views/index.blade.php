@extends('app')

@section('content')
    <main>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active slide-background">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-left text-white" style="flex: 1;">
                    <h2>Reach your desired goals</h2>
                    <p>The highest-quality proteins and supplements whether you're building muscle or shaping your physique, we've got you covered.</p>

                </div>
                <div class="text-center" style="flex: 1;">
                    <img src="../images/index/carousel1.jpg" alt="Image" class="img-carousel">
                </div>
            </div>
        </div>

        <div class="carousel-item slide-background">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-left text-white" style="flex: 1;">
                    <h2>Endurance Starts Here</h2>
                    <p>Stay energized and push your limits with our top-quality pre-workout and hydration formulas.</p>

                </div>
                <div class="text-center" style="flex: 1;">
                    <img src="../images/index/carousel2.jpg" alt="Image" class="img-carousel">
                </div>
            </div>
        </div>
        <div class="carousel-item slide-background">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-left text-white" style="flex: 1;">
                    <h2>Your Nutrition, Your Power</h2>
                    <p>Get the right nutrients to support muscle growth, fat loss, and overall well-being</p>

                </div>
                <div class="text-center" style="flex: 1;">
                    <img src="../images/index/carousel3.jpg" alt="Image" class="img-carousel">
                </div>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

        <div class="container">
            @foreach($categories as $cat)
                <button class="grid-btn" onclick="window.location.href='{{ route('products.filter', ['category' => $cat->id]) }}'">
                    {{ strtoupper($cat->name) }}
                </button>
            @endforeach
        </div>
        <div class="recommended-section">
            <h2>NEW PRODUCTS</h2>
            <div class="product-grid">
                @foreach($products as $p)
                    @if($p->stock_quantity > 0)
                    <div class="card">
                        {{-- Image --}}
                        @if($p->images->first())
                            <a href="{{ route('showProduct', $p->id) }}">
                                <img src="{{ asset('storage/'.$p->images->first()->path) }}"
                                     class="card-img-top"
                                     alt="{{ $p->name }}">
                            </a>
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="aspect-ratio: 1 / 1;">
                                <i class="bi bi-image fs-1 text-muted"></i>
                            </div>
                        @endif

                        {{-- Info --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->name }}</h5>
                            <p class="card-text">€{{ number_format($p->price, 2) }}</p>
                            <form method="POST" action="{{ route('cart.add', $p->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

</main>
@endsection
