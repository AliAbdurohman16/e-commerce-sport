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

    public function show($id)
    {
        //
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
