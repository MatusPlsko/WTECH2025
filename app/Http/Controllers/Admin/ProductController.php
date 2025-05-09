<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function menu()
    {
        return view('admin.products.menu');
    }

    // staré “index” presunieme do list()
    public function list()
    {
        $products = Product::with('images')->paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function showProducts()
    {

        $products = Product::with('images')->paginate(12);


        return view('products', compact('products'));
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
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'price'           => 'required|numeric',
            'stock_quantity'  => 'required|integer|min:0',
            'category_id'    => 'required|exists:categories,id',
            'sale'           => 'required|boolean',
            'images.*'        => 'image|max:2048',
        ]);

        $product->update([
            'name'           => $data['name'],
            'description'    => $data['description'],
            'price'          => $data['price'],
            'stock_quantity' => $data['stock_quantity'],
            'category_id'    => $data['category_id'],
            'sale'           => $data['sale'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
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
        $product->delete();
        return redirect()
            ->route('admin.products.index')
            ->with('success','Produkt bol odstránený.');
    }
}
