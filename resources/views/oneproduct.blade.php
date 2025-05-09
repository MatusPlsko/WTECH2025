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
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span class="ms-2">(4.5/5)</span>
                        </div>
                        <p class="description">
                            {{$product->description}}
                        </p>
                        <div class="quantity-selector mb-3">
                            <label for="quantity">Quantity:</label>
                            <select class="form-select" id="quantity" style="width: 100px;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-lg">Add to Cart</button>
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
                    <div class="review-item mb-4">
                        <div class="d-flex justify-content-between">
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <small class="text-muted">John Doe - March 15, 2024</small>
                        </div>
                        <h5>Great product!</h5>
                        <p>Best protein powder I've ever used. Mixes well and tastes great.</p>
                    </div>
                    <div class="review-item">
                        <div class="d-flex justify-content-between">
                            <div class="rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <small class="text-muted">Jane Smith - March 10, 2024</small>
                        </div>
                        <h5>Good quality</h5>
                        <p>Very good protein powder, would recommend to others.</p>
                    </div>
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
