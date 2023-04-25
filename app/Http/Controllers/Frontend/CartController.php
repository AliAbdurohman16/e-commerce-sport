<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;

class CartController extends Controller
{
    public function index()
    {
        // get order details data
        $orders = OrderDetail::all();

        return view('frontend.cart.index', compact('orders'));
    }
}
