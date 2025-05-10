@extends('app')
@section('content')


    <main class="container mt-4">
        <!-- Product Details -->
        <div class="product-details">
            <div class="row">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($product->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Product Image {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <div class="product-info">
                        <h1>{{$product->name}}</h1>
                        <div class="price">{{$product->price,2}} €</div>
                        <div class="rating mb-3">
                            @php
                                $averageRating = $product->averageRating();
                            @endphp

                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $averageRating)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @elseif($i - 0.5 == $averageRating)
                                    <i class="bi bi-star-half text-warning"></i>
                                @else
                                    <i class="bi bi-star text-warning"></i>
                                @endif
                            @endfor
                            <span class="ms-2">({{ number_format($averageRating, 1) }} / 5)</span>
                        </div>
                        <p class="description">
                            {{$product->description}}
                        </p>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <div class="quantity-selector mb-3">
                                <label for="quantity">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" style="width: 100px;"
                                       min="1" max="{{ $product->stock_quantity }}" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="product-tabs mt-5">
            <ul class="nav nav-tabs mb-3" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients" type="button" role="tab" aria-controls="ingredients" aria-selected="false">Ingredients</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                </li>
            </ul>
            <div class="tab-content border border-top-0 rounded-bottom p-4" id="productTabsContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <h3>Product Description</h3>
                    {{$product->description}}
                </div>
                <div class="tab-pane fade" id="ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
                    <h3>Ingredients</h3>
                    <p>Whey Protein Concentrate, Natural Flavors, Lecithin, Acesulfame Potassium, Sucralose.</p>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <h3>Customer Reviews</h3>

                    {{-- Review submission form (if logged in) --}}
                    <div class="mb-4">
                        <h5>Leave a Review</h5>
                        <form method="POST" action="{{ route('reviews.store', $product->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select class="form-select" id="rating" name="rating" style="width: 100px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} ★</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Review</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>

                    {{-- Existing reviews --}}
                    @forelse($product->reviews as $review)
                        <div class="review-item mb-4 border-bottom pb-3">
                            <div class="d-flex justify-content-between">
                                <div class="rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <small class="text-muted">
                                    {{ $review->user_id}} – {{ $review->created_at->format('F d, Y') }}
                                </small>
                            </div>
                            <p class="mt-2">{{ $review->comment }}</p>
                        </div>
                    @empty
                        <p>No reviews yet.</p>
                    @endforelse
                </div>
            </div>
        </div>




        <!-- Similar Products -->
        <div class="similar-products mt-5">
            <h2 class="text-center mb-4">Similar Products</h2>
            <div class="product-grid">
                <div class="card">
                    <img src="../images/products/product_bcaa.jpg" alt="Similar Product 1">
                    <div class="card-body">
                        <h5 class="card-title">BCAA Complex</h5>
                        <p class="card-text">29.99 €</p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                <div class="card">
                    <a href="oneproduct.html"><img src="../images/products/product_massgainer.jpg" alt="Similar Product 1"></a>
                    <div class="card-body">
                        <h5 class="card-title">Mass gainer</h5>
                        <p class="card-text">49.99 €</p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                <div class="card">
                    <a href="oneproduct.html"><img src="../images/products/product_creatin.jpg" alt="Similar Product 2"></a>
                    <div class="card-body">
                        <h5 class="card-title">Creatine Monohydrate</h5>
                        <p class="card-text">24.99 €</p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
                <div class="card">
                    <a href="oneproduct.html"><img src="../images/products/product_preworkout.jpg" alt="Similar Product 3"></a>
                    <div class="card-body">
                        <h5 class="card-title">Pre-Workout</h5>
                        <p class="card-text">34.99 €</p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
