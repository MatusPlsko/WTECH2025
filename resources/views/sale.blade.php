@extends('app')
@section('content')



<main>
    <div class="container mt-5">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-tags-fill fs-3 me-2 sale-h"></i>
            <h2 class="mb-0">Prices like never before!</h2>
        </div>
        <div class="row">
            <div class="col-12 mb-4 sale-card">
                <div class="d-flex position-relative">
                    <a href="oneproduct.html"><img src="../images/products/product_gainer.jpg" class="img-fluid rounded-start" alt="Product 1" style="width: 200px; height: auto;"></a>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 fs-6">-20%</span>
                    <div class="ms-4">
                        <h5 class="text-start">Mass Gainer</h5>
                        <p class="text-muted">A high-quality protein supplement designed to support muscle growth and recovery. It contains a balanced blend of carbohydrates and proteins to help build muscle mass.</p>
                        <p class="fw-bold">Price: <span class="text-danger">39.99€</span> <del class="text-muted">49.99€</del></p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4 sale-card">
                <div class="d-flex position-relative">
                    <a href="oneproduct.html"><img src="../images/products/product_creatin.jpg" class="img-fluid rounded-start" alt="Product 2" style="width: 200px; height: auto;"></a>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 fs-6">-40%</span>
                    <div class="ms-4">
                        <h5 class="text-start">Creatine Monohydrate</h5>
                        <p class="text-muted"> One of the most popular supplements for athletes, creatine increases strength, performance, and endurance during intense training. It helps muscles recover faster and improves energy reserves.
                        </p>
                        <p class="fw-bold">Price: <span class="text-danger">14.99€</span> <del class="text-muted">24.99€</del></p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-4 sale-card">
                <div class="d-flex position-relative">
                    <a href="oneproduct.html"><img src="../images/products/product_multivitamin.jpg" class="img-fluid rounded-start" alt="Product 3" style="width: 200px; height: auto;"></a>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 fs-6">-17%</span>
                    <div class="ms-4">
                        <h5 class="text-start">Multivitamin</h5>
                        <p class="text-muted"> A complex of vitamins and minerals that support overall health, the immune system, and daily energy levels. Ideal for both athletes and everyday individuals to maintain optimal fitness.</p>
                        <p class="fw-bold">Price: <span class="text-danger">14.99€</span> <del class="text-muted">17.99€</del></p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-4 sale-card">
                <div class="d-flex position-relative">
                    <a href="oneproduct.html"><img src="../images/products/product_zma.jpg" class="img-fluid rounded-start" alt="Product 3" style="width: 200px; height: auto;"></a>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 fs-6">-10%</span>
                    <div class="ms-4">
                        <h5 class="text-start">ZMA</h5>
                        <p class="text-muted">A combination of zinc, magnesium, and vitamin B6 that helps with recovery, improves sleep quality, and increases testosterone levels in men. Recommended for athletes to enhance performance and muscle regeneration.</p>
                        <p class="fw-bold">Price: <span class="text-danger">17.99€</span> <del class="text-muted">19.99€</del></p>
                        <a href="shopping_cart.html" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


@endsection
