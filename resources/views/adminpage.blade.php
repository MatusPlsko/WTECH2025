@extends('app')
@section('content')


    <main class="container my-5">
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="p-4 bg-light rounded">
                    <h3 class="mb-4">Add New Product</h3>
                    <div class="mb-4 text-center border p-3">
                        <i class="bi bi-image fs-1"></i>
                        <p class="mt-2">Insert images here</p>
                        <input type="file" class="form-control" multiple>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4">
                    <div class="mb-3">
                        <label class="form-label">Product name</label>
                        <input type="text" class="form-control" placeholder="Enter product name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product description</label>
                        <textarea class="form-control" rows="4" placeholder="Enter product description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" placeholder="Enter price">
                    </div>
                    <button class="btn btn-primary w-100">Add product</button>
                </div>
            </div>
        </div>

        <div class="recommended-section">
            <h2>Edit existing products</h2>
            <div class="product-grid">
                <div class="card">
                    <img src="../images/products/product_protein_1.jpg" alt="Whey Protein">
                    <div class="card-body">
                        <h3 class="card-title">Whey Protein</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/products/product_bcaa.jpg" alt="BCAA Complex">
                    <div class="card-body">
                        <h3 class="card-title">BCAA Complex</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/products/product_creatin.jpg" alt="Creatine Monohydrate">
                    <div class="card-body">
                        <h3 class="card-title">Creatine Monohydrate</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/products/product_preworkout.jpg" alt="Pre-Workout">
                    <div class="card-body">
                        <h3 class="card-title">Pre-Workout</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/products/product_gainer.jpg" alt="Mass Gainer">
                    <div class="card-body">
                        <h3 class="card-title">Mass Gainer</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/products/product_multivitamin.jpg" alt="Multivitamin">
                    <div class="card-body">
                        <h3 class="card-title">Multivitamin</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/products/product_proteinbar.jpg" alt="Protein Bar">
                    <div class="card-body">
                        <h3 class="card-title">Protein Bar</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img src="../images/products/product_omega3.jpg" alt="Omega 3">
                    <div class="card-body">
                        <h3 class="card-title">Omega 3</h3>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            <button class="btn btn-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
@endsection
