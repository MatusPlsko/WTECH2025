@extends('app')

@section('content')
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 text-center">
                <div class="card shadow-sm"
                     style="max-width:100%; width:100%; padding:2rem; background-color:#E08060; border-radius:1rem;">
                    {{-- Header --}}
                    <div class="card-header bg-white" style="padding:2rem;">
                        <h2 class="mb-0" style="font-size:2.5rem;">Product Administration</h2>
                    </div>
                    {{-- Body --}}
                    <div class="card-body" style="padding:3rem;">
                        <p style="font-size:1.25rem; margin-bottom:2rem;">
                            Do you want to add new product or edit existing one?
                        </p>
                        <div class="d-flex justify-content-center gap-4">
                            <a href="{{ route('admin.products.create') }}"
                               class="btn btn-lg btn-primary px-5 py-3"
                               style="font-size:1.25rem;">
                                <i class="bi bi-plus-circle me-2" style="font-size:1.5rem;"></i>
                                Add New Product
                            </a>
                            <a href="{{ route('admin.products.manage') }}"
                               class="btn btn-lg btn-secondary px-5 py-3"
                               style="font-size:1.25rem;">
                                <i class="bi bi-pencil-square me-2" style="font-size:1.5rem;"></i>
                                Edit / Delete Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
