<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\User;
use App\Models\Transaction;
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

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            "transaction_details" => array(
                "order_id" => $detail->order_id,
                "gross_amount" => intval($amount),
                "shipping_cost" => intval($total_shipping_cost),
            ),
            "credit_card" => array(
                "secure" => true
            ),
            "customer_details" => array(
                "first_name" => $user->name,
                "email" => $user->email,
                "phone" => $user->telephone,
                "billing_address" => array(
                    "first_name" => $user->name,
                    "email" => $user->email,
                    "phone" => $user->telephone,
                    "address" => $user->address,
                    "city" => $user->subdistrict,
                    "postal_code" => $user->postal_code,
                    "country_code" => "IDN"
                ),
                "shipping_address" => array(
                    "first_name" => $user->name,
                    "email" => $user->email,
                    "phone" => $user->telephone,
                    "address" => $user->address,
                    "city" => $user->subdistrict,
                    "postal_code" => $user->postal_code,
                    "country_code" => "IDN"
                ),
            ),
        );

        $snap_token = \Midtrans\Snap::getSnapToken($params);

        return view('frontend.checkout.index', compact('order_details', 'user', 'snap_token', 'total_shipping_cost', 'amount'));
    }

    public function store(Request $request)
    {
        // get data
        $user = Auth::user();

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

        return response()->json(['success' => true]);
    }

    public function payment(Request $request)
    {
        // Update status order by order_id
        $order = Order::where('id', $request->order_id)->first();
        $order->status = 'Sudah Checkout';
        $order->save();

        // insert data POST request
        $payment = Transaction::create([
            'user_id' => Auth::user()->id,
            'order_id' => $request->order_id,
            'payment_type' => $request->payment_type,
            'bank' => $request->bank,
            'va_number' => $request->va_number,
            'gross_amount' => $request->gross_amount,
            'status' => $request->transaction_status,
            'expired' => date('Y-m-d H:i:s', strtotime($request->expired . ' +1 days')),
        ]);

        return response()->json(['success' => true, 'message' => 'Checkout Berhasil!']);
    }

}
