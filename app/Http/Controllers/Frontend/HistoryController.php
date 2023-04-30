<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // get the currently logged in user
        $user = Auth::user();

        // get data transaction
        $transactions = Transaction::where('user_id', $user->id)
                                    ->where('status', 'success')
                                    ->get();

        // pluck order id
        $transactions->pluck('order_id');

        return view('frontend.histories.index', compact('transactions'));
    }

    public function notYetPaid()
    {
        // get the currently logged in user
        $user = Auth::user();

        // get data transaction
        $transactions = Transaction::where('user_id', $user->id)
                                    ->where('status', 'pending')
                                    ->get();

        // pluck order id
        $orderIds = $transactions->pluck('order_id');

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$clientKey = config('midtrans.client_key');
        \Midtrans\Config::$isProduction = false;

        // loop through each order id
        foreach ($orderIds as $orderId) {
            // Get transaction status from Midtrans
            $transaction = \Midtrans\Transaction::status($orderId);
            // Get transaction_status from transaction
            $status = $transaction->transaction_status;
            $orderIdMid = $transaction->order_id;

            // update transaction status if transaction_status is settlement
            if ($status == 'settlement') {
                $transaction = Transaction::where('order_id', $orderId)->first();
                $transaction->update([
                    'status' => 'success'
                ]);

                $order = Order::where('id', $orderIdMid)->where('status', 'Sudah Checkout')->first();
                $order->update([
                    'status' => 'Dalam Proses'
                ]);
            } elseif ($status == 'expire') {
                $transaction = Transaction::where('order_id', $orderId)->first();
                $transaction->update([
                    'status' => 'expired'
                ]);

                $order = Order::where('id', $orderIdMid)->where('status', 'Sudah Checkout')->first();
                // Update stock of products in the order
                foreach ($order->orderDetails as $orderDetail) {
                    $product = Product::findOrFail($orderDetail->product_id);
                    $product->stock += $orderDetail->quantity;

                    if ($product->stock < 0) {
                        $product->stock = 0;
                    }

                    $product->save();
                }
            }

        }

        return view('frontend.histories.not-yet-paid', compact('transactions'));
    }

    public function received(Request $request)
    {
        $order_id = $request->order_id;

        $order = Order::where('id', $order_id);
        $order->update([
            'status' => 'Pesanan Diterima',
        ]);

        return redirect()->back()->with('success', 'Konfirmasi pesanan diterima berhasil!');
    }
}
