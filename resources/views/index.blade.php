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
                    <a href="products.html" class="btn btn-primary">Learn More</a>
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
                    <a href="products.html" class="btn btn-primary">Learn More</a>
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
                    <a href="products.html" class="btn btn-primary">Learn More</a>
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
    <button class="grid-btn" onclick="window.location.href='products.html'">WHEY POWDER</button>
    <button class="grid-btn" onclick="window.location.href='products.html'">CREATINE</button>
    <button class="grid-btn" onclick="window.location.href='products.html'">SNACKS</button>
    <button class="grid-btn" onclick="window.location.href='products.html'">VITAMINS</button>
    <button class="grid-btn" onclick="window.location.href='products.html'">VEGAN</button>
    <button class="grid-btn" onclick="window.location.href='products.html'">HYDRATION</button>
</div>
<div class="recommended-section">
    <h2>RECOMMENDED PRODUCTS</h2>
    <div class="product-grid">
        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_protein_1.jpg" alt="Product 1"></a>
            <div class="card-body">
                <h5 class="card-title">Whey Protein</h5>
                <p class="card-text">39.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>


        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_bcaa.jpg" alt="Product 2"></a>
            <div class="card-body">
                <h5 class="card-title">BCAA Complex</h5>
                <p class="card-text">29.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>


        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_creatin.jpg" alt="Product 3"></a>
            <div class="card-body">
                <h5 class="card-title">Creatine Monohydrate</h5>
                <p class="card-text">24.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>


        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_preworkout.jpg" alt="Product 4"></a>
            <div class="card-body">
                <h5 class="card-title">Pre-Workout</h5>
                <p class="card-text">34.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>


        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_gainer.jpg" alt="Product 5"></a>
            <div class="card-body">
                <h5 class="card-title">Gainer</h5>
                <p class="card-text">44.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>


        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_vitamincomplex.jpg" alt="Product 6"></a>
            <div class="card-body">
                <h5 class="card-title">Vitamin Complex</h5>
                <p class="card-text">19.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>


        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_proteinbar.jpg" alt="Product 7"></a>
            <div class="card-body">
                <h5 class="card-title">Protein Bar</h5>
                <p class="card-text">2.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>


        <div class="card">
            <a href="oneproduct.html"><img src="../images/products/product_omega3.jpg" alt="Product 8"></a>
            <div class="card-body">
                <h5 class="card-title">Omega 3</h5>
                <p class="card-text">15.99 €</p>
                <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>
        </div>
    </div>
</div>

</main>
@endsection
