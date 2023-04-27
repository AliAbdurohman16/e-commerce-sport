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

            // create item details
            // $item_details[] = [
            //     'id' => $detail->product_id,
            //     'price' => $detail->total,
            //     'quantity' => $detail->quantity,
            //     'name' => $detail->product->name,
            // ];
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-1zZ935BBzYSassJ7t24ER6_b';
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
            // "item_details" => $item_details,
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

    public function payment(Request $request)
    {
        // get notifications data from Midtrans
        $payload = $request->getContent();
        $notification = json_decode($payload);

        // Checks if the notification is valid
        if (!$notification || !isset($notification->order_id)) {
            // return
        }
    }
}
