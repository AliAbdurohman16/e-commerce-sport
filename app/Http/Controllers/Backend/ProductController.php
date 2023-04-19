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
        # code...
    }

    public function update(Request $request,$id)
    {
        return $request->all();
    }

    public function destroy($id)
    {
        # code...
    }
}
