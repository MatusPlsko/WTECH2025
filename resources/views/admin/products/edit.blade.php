@extends('app')

@section('content')
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Edit Product</h4>
                    </div>
                    <div class="card-body">

                        {{-- Validation Errors --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.products.update', $product) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf @method('PUT')

                            <div class="row g-4">

                                {{-- Left: Image preview + upload --}}
                                <div class="col-md-4">
                                    <label class="form-label">Product Images</label>
                                    <div
                                        id="images-preview"
                                        class="border rounded p-3 text-center bg-light"
                                        style="min-height:180px; position:relative;"
                                    >
                                        {{-- show existing thumbs --}}
                                        @foreach($product->images as $img)
                                            <img
                                                src="{{ asset('storage/'.$img->path) }}"
                                                class="thumb me-2 mb-2"
                                                style="height:60px; object-fit:cover; border-radius:4px;"
                                            >
                                        @endforeach

                                        {{-- placeholder if no images --}}
                                        @if($product->images->isEmpty())
                                            <div class="text-secondary">
                                                <i class="bi bi-image fs-1"></i>
                                                <p class="mt-2 mb-0">Click to add (min. 2)</p>
                                            </div>
                                        @endif

                                        {{-- invisible input in same box --}}
                                        <input
                                            id="images-input"
                                            type="file"
                                            name="images[]"
                                            multiple
                                            accept="image/*"
                                            class="position-absolute top-0 start-0 w-100 h-100"
                                            style="opacity:0; cursor:pointer;"
                                        >
                                    </div>
                                </div>

                                {{-- Right: Text fields --}}
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ old('name',$product->name) }}"
                                            class="form-control"
                                            required
                                        >
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea
                                            name="description"
                                            class="form-control"
                                            rows="4"
                                            required
                                        >{{ old('description',$product->description) }}</textarea>
                                    </div>

                                    <div class="row gx-3">
                                        <div class="col">
                                            <label class="form-label">Price (€)</label>
                                            <input
                                                type="number"
                                                name="price"
                                                value="{{ old('price',$product->price) }}"
                                                step="0.01"
                                                class="form-control"
                                                required
                                            >
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Stock</label>
                                            <input
                                                type="number"
                                                name="stock_quantity"
                                                value="{{ old('stock_quantity',$product->stock_quantity) }}"
                                                class="form-control"
                                                min="0"
                                                required
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Submit buttons --}}
                            <div class="mt-4 text-end">
                                <a href="{{ route('admin.products.index') }}"
                                   class="btn btn-outline-secondary me-2">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>
                                    Update Product
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </main>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const inp   = document.getElementById('images-input');
                const prev  = document.getElementById('images-preview');

                inp.addEventListener('change', () => {
                    // remove NEW thumbs only
                    prev.querySelectorAll('img.new').forEach(el => el.remove());

                    const files = Array.from(inp.files);
                    if (files.length) {
                        // hide placeholder texts
                        prev.querySelectorAll('div.text-secondary').forEach(d => d.style.display='none');
                    }
                    files.forEach(file => {
                        if (!file.type.startsWith('image/')) return;
                        const reader = new FileReader();
                        reader.onload = e => {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('new','me-2','mb-2');
                            img.style.height = '60px';
                            img.style.objectFit = 'cover';
                            img.style.borderRadius = '4px';
                            prev.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>
    @endpush
@endsection
