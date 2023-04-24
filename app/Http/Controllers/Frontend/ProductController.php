<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        //
    }

    public function show($slug)
    {
        // get data where slug
        $product = Product::with(['images', 'discounts'])->where('slug', $slug)->firstOrFail();

        // get related products
        $relatedProducts = Product::with(['images', 'discounts'])
                            ->where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->take(10)
                            ->get();

        return view('frontend.products.detail', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        // get user's search input
        $search = $request->input('key');

        // retrieve products that match the search input
        $products = Product::with(['images', 'discounts'])
                    ->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%")
                    ->paginate(10);

        return view('frontend.search.index', compact('products', 'search'));
    }
}
