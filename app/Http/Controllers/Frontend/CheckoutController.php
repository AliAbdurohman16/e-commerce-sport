<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect('login');
        }

        // get order data for the logged in user
        $orders = Order::where('user_id', $user->id)->get();

        // get order details data for the logged in user
        $order_details = OrderDetail::whereHas('order', function ($query) {
            $query->where('user_id', Auth::user()->id)
            ->where('status', 'Belum Checkout');
        })->get();

        // check if the products in the order details have sufficient stock
        foreach ($order_details as $detail) {
            if ($detail->product->stock == 0) {
                return redirect('carts')->with('error', 'Stok produk '.$detail->product->name.' habis!');
            }
        }

        return view('frontend.checkout.index', compact('order_details'));
    }
}
