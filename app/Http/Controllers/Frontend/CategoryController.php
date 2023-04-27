<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index($slug)
    {
        // get category data where slug
        $category = Category::where('slug', $slug)->first();

        // get data products
        $products = Product::with(['images', 'discounts'])
                    ->where('category_id', $category->id)
                    ->latest()
                    ->paginate(8);

        return view('frontend.categories.index', compact('products', 'category'));
    }
}
