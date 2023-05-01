<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // get all data products
        $products = Product::with(['images', 'discounts'])->get();

        // get popular products
        $popularProducts = Product::with(['images', 'discounts'])
                                    ->withCount(['orderDetails as total_quantity' => function($query){
                                        $query->select(DB::raw("sum(quantity)"));
                                    }])
                                    ->whereHas('orderDetails', function($query){
                                        $query->where('quantity', '>', 0);
                                    })
                                    ->orderBy('total_quantity', 'desc')
                                    ->take(4)
                                    ->get();

        // get recent products
        $recentProducts = Product::with(['images', 'discounts'])->orderBy('created_at', 'desc')
                                    ->latest()->take(4)->get();

        // get all data categories
        $categories = Category::all();

        // get setting data
        $setting = Setting::find(1);

        return view('frontend.home.index', compact('products', 'categories', 'popularProducts', 'recentProducts', 'setting'));
    }
}
