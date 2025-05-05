@extends('app')
@section('content')

    <main class="container mt-4">
        <div class="row">
            <div class="col-lg-7">
                <div class="cart-items">
                    <div class="cart-item p-3 mb-3 d-flex align-items-center gap-3">
                        <img src="../images/products/product_protein_1.jpg" alt="Whey Protein" class="cart-item-image">
                        <div class="flex-grow-1">
                            <h3 class="cart-item-title h5 mb-2">Whey Protein Premium</h3>
                            <div class="cart-item-price mb-2">39.99 €</div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="quantity-btn">-</button>
                                <input type="number" class="form-control w-25 text-center" value="1" min="1">
                                <button class="quantity-btn">+</button>
                            </div>
                        </div>
                        <button class="btn text-white">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>

                    <div class="cart-item p-3 mb-3 d-flex align-items-center gap-3">
                        <img src="../images/products/product_creatin.jpg" alt="Creatine" class="cart-item-image">
                        <div class="flex-grow-1">
                            <h3 class="cart-item-title h5 mb-2">Creatine Monohydrate</h3>
                            <div class="cart-item-price mb-2">24.99 €</div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="quantity-btn">-</button>
                                <input type="number" class="form-control w-25 text-center" value="2" min="1">
                                <button class="quantity-btn">+</button>
                            </div>
                        </div>
                        <button class="btn text-white">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="cart-summary p-4">
                    <h4 class="text-white mb-4">Order Details</h4>

                    <div class="mb-4">
                        <h5 class="text-white mb-3">Contact Information</h5>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" placeholder="Phone Number" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-white mb-3">Shipping Address</h5>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Street Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Apartment, suite, etc. (optional)">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="City" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Postal Code" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" required>
                                <option value="" disabled selected>Select Country</option>
                                <option value="SK">Slovakia</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="HU">Hungary</option>
                                <option value="PL">Poland</option>
                                <option value="AT">Austria</option>
                                <option value="DE">Germany</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-white mb-3">Payment Method</h5>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                                <label class="form-check-label text-white" for="creditCard">
                                    <i class="bi bi-credit-card me-2"></i>Credit/Debit Card
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                                <label class="form-check-label text-white" for="paypal">
                                    <i class="bi bi-paypal me-2"></i>PayPal
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer">
                                <label class="form-check-label text-white" for="bankTransfer">
                                    <i class="bi bi-bank me-2"></i>Bank Transfer
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery">
                                <label class="form-check-label text-white" for="cashOnDelivery">
                                    <i class="bi bi-cash me-2"></i>Cash on Delivery
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-3 mb-4">
                        <h5 class="text-white mb-3">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>89.97 €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Discount</span>
                            <span>-5.50 €</span>
                        </div>

                        <div class="mb-4">
                            <input type="text" class="form-control mb-2" placeholder="Enter discount code">
                            <button class="btn btn-outline-light w-100">Apply Discount</button>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3 mb-4 fw-bold">
                            <span>Total</span>
                            <span>84.57 €</span>
                        </div>
                        <button class="btn btn-primary w-100 py-2">
                            Proceed to Checkout<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
