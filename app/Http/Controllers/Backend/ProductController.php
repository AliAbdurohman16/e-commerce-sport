<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        // get data
        $products = Product::with('images')->get();

        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        // get data
        $categories = Category::all();

        return view('backend.products.add', compact('categories'));
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'image' => 'required|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'category' => 'required',
            'weight' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);

        // insert to table products
        $products = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'category_id' => $request->category,
            'weight' => $request->weight,
            'unit' => $request->unit,
            'price' => $request->price,
            'stock' => $request->stock,
            'sizes' => $request->sizes,
            'colors' => $request->colors,
            'description' => $request->description,
        ]);

        // process upload image multiple
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/products'));

                Image::create([
                    'path' => $path,
                    'product_id' => $products->id,
                ]);
            }
        }

        return redirect('products')->with('message', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        # code...
    }

    public function edit($id)
    {
        // get data find or fail by id
        $products = Product::findOrFail($id);

        // get all data categories
        $categories = Category::all();

        return view('backend.products.edit', compact('products', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // validation
        $request->validate([
            'image' => 'required|max:2048',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
            'category' => 'required',
            'weight' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);

        // get data find or fail by id
        $product = Product::findOrFail($id);

        // process upload image multiple
        if ($request->hasFile('image')) {
            foreach ($product->images as $image) {
                Storage::delete('public/products/' . $image->path);
                $image->delete();
            }

            $images = $request->file('image');
            foreach ($images as $image) {
                $path = basename($image->store('public/products'));

                Image::create([
                    'path' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }

        // update to table products
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'category_id' => $request->category,
            'weight' => $request->weight,
            'unit' => $request->unit,
            'price' => $request->price,
            'stock' => $request->stock,
            'sizes' => $request->sizes,
            'colors' => $request->colors,
            'description' => $request->description,
        ]);

        return redirect('products')->with('message', 'Produk berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data find or fail by id
        $product = Product::findOrFail($id);

        // process delete image
        foreach ($product->images as $image) {
            Storage::delete('public/products/' . $image->path);
            $image->delete();
        }

        // delete data
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus!']);
    }
}
