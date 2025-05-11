@extends('app')

@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        $user = Auth::user();
        $total = 0;
    @endphp

    <main class="container mt-4">
        <div class="row">
            <div class="col-lg-7">
                <div class="cart-items">
                    @foreach($cart as $id => $item)
                        @php
                            $total += $item['price'] * $item['quantity'];
                        @endphp
                        <div class="cart-item p-3 mb-3 d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                 class="cart-item-image"
                                 alt="{{ $item['name'] }}">
                            <div class="flex-grow-1">
                                <h3 class="cart-item-title h5 mb-2">{{ $item['name'] }}</h3>
                                <div class="cart-item-price mb-2">{{ number_format($item['price'], 2) }} €</div>
                                <div class="d-flex align-items-center gap-2">
                                    <form method="POST" action="{{ route('cart.update', $id) }}">
                                        @csrf
                                        <button class="quantity-btn" name="action" value="decrease">-</button>
                                        <input type="number" name="quantity" class="form-control w-25 text-center" value="{{ $item['quantity'] }}" min="1">
                                        <button class="quantity-btn" name="action" value="increase">+</button>
                                    </form>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf
                                <button class="btn text-white">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-5">
                <div class="cart-summary p-4">
                    <h4 class="text-white mb-4">Order Details</h4>

                    <form method="POST" action="{{ route('cart.checkout') }}">
                        @csrf

                        <div class="mb-4">
                            <h5 class="text-white mb-3">Contact Information</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="First Name" required
                                       value="{{ old('first_name', $user->first_name ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Last Name" required
                                       value="{{ old('last_name', $user->last_name ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" required
                                       value="{{ old('email', $user->email ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control" placeholder="Phone Number" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-white mb-3">Shipping Address</h5>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Street Address" required
                                       value="{{ old('address', $user->address ?? '') }}">
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
                                <span>{{ number_format($total, 2) }} €</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                @php
                                    $shipping = count($cart) === 0 ? 0 : 4.40;
                                    $finalTotal = $total + $shipping;
                                @endphp
                                <span>Shipping</span>
                                <span>{{ number_format($shipping, 2) }} €</span>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-3 mb-4 fw-bold">
                                <span>Total</span>
                                <span>{{ number_format($finalTotal, 2) }} €</span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Proceed to Checkout<i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
