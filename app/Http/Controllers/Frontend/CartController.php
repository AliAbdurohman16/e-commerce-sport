<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
            ->where('is_checkout', null);
        })->get();

        return view('frontend.cart.index', compact('order_details'));
    }

    public function store(Request $request)
    {
        // get data by request
        $ids = $request->id;
        $quantities = $request->quantity;

        // looping quantity
        foreach ($quantities as $key => $quantity) {
            $order_detail_id = $ids[$key];
            $order_detail = OrderDetail::findOrFail($order_detail_id);

            // checking quantity 0
            if ($quantity == 0) {
                return redirect('carts')->with('error', 'Pada produk '.$order_detail->product->name.' quantity tidak boleh 0!');
            }

            // checking discount product
            if ($order_detail->product->discounts->count() > 0) {
                $discount = $order_detail->product->discounts->first()->discount_percentage;
                $discountedPrice = $order_detail->product->price - ($order_detail->product->price * ($discount / 100));
                $total = $quantity * $discountedPrice;
            } else {
                $total = $quantity * $order_detail->product->price;
            }

            // insert to table
            $order_detail->quantity = $quantity;
            $order_detail->total = $total;
            $order_detail->save();
        }

        // sum total
        $subtotal = OrderDetail::where('order_id', $order_detail->order_id)->sum('total');

        // find by id
        $order = Order::findOrFail($order_detail->order_id);

        // insert to table
        $order->subtotal = $subtotal;
        $order->save();

        return redirect('checkout');
    }

    public function destroy($id)
    {
        // find or fail by id
        $order_details = OrderDetail::findOrFail($id);

        // delete data
        $order_details->delete();

        return response()->json(['success', 'Produk berhasil dihapus dari keranjang!']);
    }
}
