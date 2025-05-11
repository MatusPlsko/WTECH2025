@extends('app')

@section('content')

    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-receipt-cutoff fs-3 me-2 icon-custom"></i>
                        <h2 class="mb-0">Your Orders</h2>
                    </div>

                    @if($orders->isEmpty())
                        <p class="text-muted">You have no orders.</p>
                    @else
                        <div class="row">
                            @foreach ($orders as $order)
                                <div class="col-12 mb-4 sale-card">
                                    <div class="d-flex position-relative">
                                        <i class="bi bi-box-seam fs-1 text-secondary me-4"></i>
                                        <div>
                                            <h5 class="text-start mb-1">Order #{{ $order->id }}</h5>
                                            <p class="mb-1 text-muted">Status: <span class="text-dark">{{ ucfirst($order->status) }}</span></p>
                                            <p class="fw-bold">Total: <span class="text-success">{{ number_format($order->total_price, 2) }}€</span></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

@endsection
