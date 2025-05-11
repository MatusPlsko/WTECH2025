<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductController extends Controller
{
    public function menu()
    {
        return view('admin.products.menu');
    }

    // staré “index” presunieme do list()
    public function list()
    {
        $products = Product::with('images')->paginate(16);
        return view('admin.products.index', compact('products'));
    }

    public function showProducts(Request $request)
    {
        // 1) načítame produkty (bez filtra)
        $products = Product::with('images')->paginate(12);

        // 2) načítame všetky kategórie pre sidebar a header
        $categories = Category::all();

        // 3) nastavíme "aktuálnu" kategóriu na null
        $currentCategory = null;

        // 4) pošleme do view
        return view('products', compact('products', 'categories', 'currentCategory'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string',
            'brand'          => 'required|in:TechNutrition,BeamNutrition,ProteinTech,BioTech,Wsupplements',
            'price'          => 'required|numeric',
            'stock_quantity' => 'required|integer|min:0',
            'category_id'    => 'required|exists:categories,id',
            'sale'           => 'required|boolean',
            'images'         => 'required|array|min:2',
            'images.*'       => 'image|max:2048',
        ]);

        // 1) Store all files
        $paths = [];
        foreach ($request->file('images') as $file) {
            $paths[] = $file->store('products', 'public');
        }

        // 2) Create the product, now including image_url, sale, and rating
        $product = Product::create([
            'name'           => $data['name'],
            'description'    => $data['description'],
            'brand'          => $data['brand'],
            'price'          => $data['price'],
            'stock_quantity' => $data['stock_quantity'],
            'category_id'    => $data['category_id'],
            'sale'           => $data['sale'],
            'image_url'      => $paths[0],
            'rating'         => 0,
        ]);

        // 3) Save all image records
        foreach ($paths as $path) {
            $product->images()->create(['path' => $path]);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success','Produkt úspešne vytvorený.');
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'description'      => 'required|string',
            'brand'          => 'required|in:TechNutrition,BeamNutrition,ProteinTech,BioTech,Wsupplements',
            'price'            => 'required|numeric',
            'stock_quantity'   => 'required|integer|min:0',
            'category_id'      => 'required|exists:categories,id',
            'sale'             => 'required|boolean',
            'replace_images.*' => 'nullable|image|max:2048',
            'delete_images'    => 'array',
            'delete_images.*'  => 'integer|exists:product_images,id',
            'new_images.*'     => 'nullable|image|max:2048',
        ]);

        // 1) Základné update atributov
        $product->update($data);

        // 2) Spracuj zmazanie vybraných obrázkov
        if ($request->filled('delete_images')) {
            foreach ($request->input('delete_images') as $imgId) {
                $img = $product->images()->find($imgId);
                if ($img) {
                    Storage::disk('public')->delete($img->path);
                    $img->delete();
                }
            }
        }

        // 3) Spracuj náhradu vybraných obrázkov
        if ($request->hasFile('replace_images')) {
            foreach ($request->file('replace_images') as $imgId => $file) {
                if ($file) {
                    $img = $product->images()->find($imgId);
                    if ($img) {
                        Storage::disk('public')->delete($img->path);
                        $path = $file->store('products', 'public');
                        $img->update(['path' => $path]);
                    }
                }
            }
        }

        // 4) Pridaj nové obrázky
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $path = $file->store('products', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success','Produkt bol aktualizovaný.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        // 2) Odstrániť záznamy v databáze product_images (ak nemáte ON DELETE CASCADE)
        $product->images()->delete();

        $product->delete();
        return redirect()
            ->route('admin.products.index')
            ->with('success','Produkt bol úspešne odstránený.');
    }

    public function index(Request $request)
    {
        // validujeme min/max price
        $validated = $request->validate([
            'min_price' => 'nullable|numeric|min:0|lte:max_price',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
            'q'         => 'nullable|string',
            'category'  => 'nullable|exists:categories,id',
            'brands'    => 'nullable|array',
            'brands.*'  => 'in:TechNutrition,BeamNutrition,ProteinTech,BioTech,Wsupplements',
        ]);

        $query = Product::query();

        $min = $validated['min_price'] ?? null;
        $max = $validated['max_price'] ?? null;

        if ($validated['q'] ?? false) {
            $query->fullTextSearch($validated['q']);
        }
        if ($min !== null) {
            $query->where('price','>=',$min);
        }
        if ($max !== null) {
            $query->where('price','<=',$max);
        }
        if (! empty($validated['category'])) {
            $query->where('category_id', $validated['category']);
        }
        if (!empty($validated['brands'])) {
            $query->whereIn('brand', $validated['brands']);
        }
        if ($sort = $request->input('sort')) {
            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            }
            elseif ($sort === 'rating') {
                $query->orderBy('rating');
            }
        }

        $products = $query->paginate(16)->withQueryString();

        return view('products', [
            'products'        => $products,
            'categories'      => Category::all(),
            'currentCategory' => $validated['category'] ?? null,
            'minPrice'        => $min,
            'maxPrice'        => $max,
            'sort'            => $validated['sort'] ?? null,
            'selectedBrands'  => $validated['brands'] ?? [],

        ]);
    }
    public function filter(Request $request, $categoryId)
    {

        $categories = Category::all();
        $query = Product::with('images')->where('category_id', $categoryId);

        if ($sort = $request->input('sort')) {
            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($sort === 'newest') {
                $query->orderBy('created_at', 'desc');
            }
        }

        $products = Product::with('images')
            ->where('category_id', $categoryId)
            ->paginate(12);

        // teraz pri filtrovaní je nastavená práve táto
        $currentCategory = $categoryId;
        $products = $query->paginate(12)->withQueryString();

        return view('products', compact('products','categories','currentCategory','sort'));
    }
}
