<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // get data where slug
        $products = Product::with(['images', 'discounts'])->latest()->paginate(10);

        return view('frontend.products.index', compact('products'));
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

    public function discount()
    {
        // get data where slug
        $products = Product::with(['images', 'discounts'])
                    ->whereHas('discounts', function ($query) {
                        $query->where('start_date', '<=', now())
                            ->where('end_date', '>=', now());
                    })
                    ->latest()
                    ->paginate(10);

        return view('frontend.products.discount', compact('products'));
    }

    public function addToCart(Request $request, $id)
    {
        //
    }
}
