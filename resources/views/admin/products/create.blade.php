@extends('app')

@section('content')
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Add New Product</h4>
                    </div>

                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.products.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                {{-- images --}}
                                <div class="col-md-4">
                                    <label class="form-label d-block">
                                        Product Images <small class="text-muted">(min. 2)</small>
                                    </label>

                                    {{-- relatívny kontajner PRE ONLY tento box --}}
                                    <div
                                        id="images-preview"
                                        class="border rounded p-3 text-center bg-light"
                                        style="min-height:180px; position:relative; max-width:240px;"
                                    >
                                        {{-- placeholder --}}
                                        <div id="images-placeholder" class="text-secondary">
                                            <i class="bi bi-image fs-1"></i>
                                            <p class="mt-2 mb-0">Drag &amp; drop<br>or click to select</p>
                                        </div>

                                        {{-- transparentný input iba v tomto boxe --}}
                                        <input
                                            id="images-input"
                                            type="file"
                                            name="images[]"
                                            multiple
                                            accept="image/*"
                                            required
                                            style="
        position:absolute;
        top:0; left:0;
        width:100%; height:100%;
        opacity:0;
        cursor:pointer;
        z-index:10;
      "
                                        >
                                    </div>
                                </div>

                                {{-- fields --}}
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text"
                                               name="name"
                                               value="{{ old('name') }}"
                                               class="form-control"
                                               placeholder="Enter product name"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="description"
                                                  class="form-control"
                                                  rows="4"
                                                  placeholder="Enter product description"
                                                  required>{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Brand</label>
                                        <select
                                            name="brand"
                                            class="form-select @error('brand') is-invalid @enderror"
                                            required
                                        >
                                            <option value="">-- vyber brand --</option>
                                            <option value="TechNutrition"    {{ old('brand')=='TechNutrition'    ? 'selected':'' }}>TechNutrition</option>
                                            <option value="BeamNutrition"    {{ old('brand')=='BeamNutrition'    ? 'selected':'' }}>BeamNutrition</option>
                                            <option value="ProteinTech"      {{ old('brand')=='ProteinTech'      ? 'selected':'' }}>ProteinTech</option>
                                            <option value="BioTech"          {{ old('brand')=='BioTech'          ? 'selected':'' }}>BioTech</option>
                                            <option value="Wsupplements"     {{ old('brand')=='Wsupplements'     ? 'selected':'' }}>Wsupplements</option>
                                        </select>
                                        @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="category_id"
                                                class="form-select @error('category_id') is-invalid @enderror"
                                                required>
                                            <option value="">-- vyber kategóriu --</option>
                                            @foreach(\App\Models\Category::all() as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Price (€)</label>
                                            <input type="number"
                                                   name="price"
                                                   value="{{ old('price') }}"
                                                   step="0.01"
                                                   class="form-control"
                                                   placeholder="0.00"
                                                   required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="sale" class="form-label">On Sale?</label>
                                            <select name="sale" id="sale" class="form-select" required>
                                                <option value="0" {{ old('sale') === '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{ old('sale') === '1' ? 'selected' : '' }}>Yes</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label">Stock</label>
                                            <input type="number"
                                                   name="stock_quantity"
                                                   value="{{ old('stock_quantity',0) }}"
                                                   class="form-control"
                                                   min="0"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary me-2">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i> Add Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inp   = document.getElementById('images-input');
            const prev  = document.getElementById('images-preview');
            const place = document.getElementById('images-placeholder');

            inp.addEventListener('change', function() {
                // odstrániť staré náhľady
                prev.querySelectorAll('img.thumb').forEach(el => el.remove());

                const files = Array.from(this.files);
                if (!files.length) {
                    place.style.display = '';
                    return;
                }
                place.style.display = 'none';

                files.forEach(file => {
                    if (!file.type.startsWith('image/')) return;
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('thumb', 'me-2', 'mb-2');
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

@endsection
