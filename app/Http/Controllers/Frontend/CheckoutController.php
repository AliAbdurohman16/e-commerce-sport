<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Shipping;
use App\Models\Product;
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

        if (!$order_details->count() >0 ) {
            return redirect('/');
        }

        // initializing shipping cost
        $total_shipping_cost = 0;

        // check if the products in the order details have sufficient stock
        foreach ($order_details as $detail) {
            if ($detail->product->stock == 0) {
                return redirect('carts')->with('error', 'Stok produk '.$detail->product->name.' habis!');
            } elseif ($detail->product->stock < $detail->quantity) {
                return redirect('carts')->with('error', 'Stok produk '.$detail->product->name.' tidak mencukupi!');
            }

            // creating shipping cost
            $cost = 10000;

            if ($detail->product->weight && $detail->product->unit == 'g') {
                $weight = $detail->product->weight / 1000;
                $calculate = $weight * $cost;
                $shipping_cost = $calculate * $detail->quantity;
            } elseif ($detail->product->weight && $detail->product->unit == 'kg') {
                $shipping_cost = $cost * $detail->quantity;
            }

            // update total shipping cost
            $total_shipping_cost += $shipping_cost;

            // create amount
            $amount = $detail->order->subtotal + $total_shipping_cost;
        }

        return view('frontend.checkout.index', compact('order_details', 'user', 'total_shipping_cost', 'amount'));
    }

    public function store(Request $request)
    {
        // get data
        $user = Auth::user();

        // validation
        $request->validate([
            'name' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'postal_code' => 'required',
            'receipt' => 'required|mimes:jpg,png,jpeg|image|max:2048',
        ]);

        // update to table
        $user->update([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
            'postal_code' => $request->postal_code,
        ]);

        // Update status order by order_id
        $order = Order::where('id', $request->order_id)->first();
        $order->status = 'Sudah Checkout';
        $order->save();

        // Update stock of products in the order
        foreach ($order->orderDetails as $orderDetail) {
            $product = Product::findOrFail($orderDetail->product_id);
            $product->stock -= $orderDetail->quantity;

            if ($product->stock < 0) {
                $product->stock = 0;
            }

            $product->save();
        }

        // process upload receipt
        if ($request->hasFile('receipt')) {
            $receiptPath = $request->file('receipt')->store('public/checkout');
            $receiptName = basename($receiptPath);
        } else {
            $receiptName = '';
        }

        // insert data POST request
        $payment = Transaction::create([
            'user_id' => Auth::user()->id,
            'order_id' => $request->order_id,
            'gross_amount' => $request->gross_amount,
            'receipt' => $receiptName,
        ]);

        // insert data shipping
        Shipping::create([
            'order_id' => $request->order_id,
            'cost' => $request->shipping_cost
        ]);

        return redirect('payment')->with('success', 'Checkout berhasil!');
    }
}
