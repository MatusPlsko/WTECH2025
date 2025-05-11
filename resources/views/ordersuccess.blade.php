@extends('app')

@section('content')
    <main class="container mt-5">
        <div class="text-center">
            <h1 class="mb-4">Thank you for your order!</h1>
            <p class="lead">Your order number is {{ $order->id }}</p>

            <div class="alert alert-success mt-4" role="alert">
                @if($order->status === 'pending')
                    Your order has been processed successfully.
                @else
                    Unfortunately, there was an issue with your order.
                @endif
            </div>


        </div>
    </main>
@endsection
