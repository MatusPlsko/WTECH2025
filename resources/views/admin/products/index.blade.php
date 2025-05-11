@extends('app')

@section('content')
    <main class="container my-5">
        <div class="products-section">
            {{-- Header with flex, title on the left, “Add New” on the right --}}
            <div class="d-flex align-items-center mb-4">
                <h3 class="h3 mb-0 text-secondary fw-bold">
                    Edit Existing Products
                </h3>
                <div class="ms-auto">
                    <a href="{{ route('admin.products.create') }}"
                       class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Add New
                    </a>
                </div>
            </div>

            {{-- Grid: 1 col xs, 2 col sm, 4 col md  --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($products as $p)
                    <div class="col">
                        <div class="card h-100 border-0" style="background:#E08060; border-radius:1rem;">
                            {{-- Image (fixed 180px height) --}}
                            @if($p->images->first())
                                <img src="{{ asset('storage/'.$p->images->first()->path) }}"
                                     class="card-img-top"
                                     style="height:180px; object-fit:cover; border-top-left-radius:1rem; border-top-right-radius:1rem;"
                                     alt="{{ $p->name }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                     style="height:180px; border-top-left-radius:1rem; border-top-right-radius:1rem;">
                                    <i class="bi bi-image fs-1 text-muted"></i>
                                </div>
                            @endif

                            {{-- Name & Price --}}
                            <div class="card-body text-center text-white">
                                <h5 class="card-title mb-1">{{ $p->name }}</h5>
                                <p class="mb-0">€{{ number_format($p->price, 2) }}</p>
                            </div>

                            {{-- Edit & Delete --}}
                            <div class="card-footer bg-transparent border-0 d-flex justify-content-center gap-2 pb-3">
                                <a href="{{ route('admin.products.edit', $p) }}"
                                   class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $p) }}"
                                      method="POST"
                                      onsubmit="return confirm('Naozaj zmazať tento produkt?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-light">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                {{-- prázdny div, aby šípky boli vpravo --}}
                <div></div>
                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
