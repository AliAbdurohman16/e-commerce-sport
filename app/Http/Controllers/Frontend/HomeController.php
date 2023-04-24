<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // get all data products
        $products = Product::with(['images', 'discounts'])->get();
        // $price = $products->price % $products->discounts->discount_percentage;
        // echo $price;

        // get all data categories
        $categories = Category::all();

        return view('frontend.home.index', compact('products', 'categories'));
    }
}
