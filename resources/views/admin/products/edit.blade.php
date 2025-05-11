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

                                <div class="col-md-4">
                                    <label class="form-label">Existing Images</label>


                                    @foreach($product->images as $img)
                                        <div class="mb-3 border rounded p-3 d-flex align-items-center">
                                            {{-- Thumbnail --}}
                                            <img
                                                src="{{ asset('storage/'.$img->path) }}"
                                                alt="thumb"
                                                id="preview_img_{{ $img->id }}"
                                                style="height:80px; object-fit:cover; border-radius:4px;"
                                                class="me-3"
                                            >

                                            {{-- Replace + Delete kontejner --}}
                                            <div class="row flex-grow-1 gx-2 gy-1 align-items-center">
                                                {{-- zmenené: col-auto → col, input dostal w-100 a nowrap --}}
                                                <div class="col text-nowrap">
                                                    <label class="form-label mb-1">Replace:</label>
                                                    <input
                                                        type="file"
                                                        name="replace_images[{{ $img->id }}]"
                                                        accept="image/*"
                                                        class="form-control form-control-sm w-100"
                                                        style="white-space: nowrap;"
                                                        data-target="#preview_img_{{ $img->id }}"
                                                    >
                                                </div>
                                                <div class="col-auto text-nowrap">
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            name="delete_images[]"
                                                            value="{{ $img->id }}"
                                                            id="delete_img_{{ $img->id }}"
                                                        >
                                                        <label class="form-check-label mb-0 ps-2" for="delete_img_{{ $img->id }}">
                                                            Delete
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach



                                    {{-- Add new images --}}
                                    <label class="form-label mt-4">
                                        Add New Images <small class="text-muted">(opt.)</small>
                                    </label>
                                    <input
                                        type="file"
                                        id="new_images"              {{-- dôležité, id musí sedieť --}}
                                        name="new_images[]"
                                        multiple
                                        accept="image/*"
                                        class="form-control form-control-sm mb-2"
                                    >

                                    <div id="new_images_preview" class="d-flex flex-wrap gap-2 mb-4">
                                        {{-- sem sa dorobia preview thumbnaily --}}
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

                                    <div class="mb-3">
                                        <label class="form-label">Brand</label>
                                        <select name="brand" class="form-select" required>
                                            <option value="">-- vyber brand --</option>
                                            @foreach(['TechNutrition','BeamNutrition','ProteinTech','BioTech','Wsupplements'] as $brand)
                                                <option
                                                    value="{{ $brand }}"
                                                    {{ old('brand', $product->brand)==$brand ? 'selected' : '' }}
                                                >
                                                    {{ $brand }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" class="form-select" required>
                                            <option value="">-- vyber kategóriu --</option>
                                            @foreach(\App\Models\Category::all() as $cat)
                                                <option
                                                    value="{{ $cat->id }}"
                                                    {{ old('category_id', $product->category_id)==$cat->id ? 'selected' : '' }}
                                                >
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
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

                                        <div class="mb-3">
                                            <label for="sale" class="form-label">On Sale?</label>
                                            <select name="sale" id="sale" class="form-select" required>
                                                <option value="0" {{ old('sale', $product->sale) == 0 ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ old('sale', $product->sale) == 1 ? 'selected' : '' }}>Yes</option>
                                            </select>
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
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input.replace-input').forEach(input => {
                    input.addEventListener('change', function() {
                        const file = this.files[0];
                        if (!file) return;

                        const preview = document.querySelector(this.dataset.target);
                        if (!preview) return;

                        const reader = new FileReader();
                        reader.onload = e => preview.src = e.target.result;
                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('new_images');
                const preview = document.getElementById('new_images_preview');

                input.addEventListener('change', function() {
                    // vymažeme staré
                    preview.innerHTML = '';

                    Array.from(this.files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.height = '60px';
                            img.style.objectFit = 'cover';
                            img.style.borderRadius = '4px';
                            img.classList.add('me-2','mb-2');
                            preview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            });
        </script>





    @endpush
@endsection
