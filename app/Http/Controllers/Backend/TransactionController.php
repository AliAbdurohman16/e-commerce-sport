<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Product;

class TransactionController extends Controller
{
    public function index()
    {
        // get transaction data
        $transactions = Transaction::all();

        return view('backend.transaction.index', compact('transactions'));
    }

    public function validationTrans(Request $request)
    {
        // request order id
        $order_id = $request->order_id;

        // update status
        $transaction = Transaction::where('order_id', $order_id)->first();
        $transaction->status = 'success';
        $transaction->save();

        if ($transaction) {
            // Update status order by order_id
            $order = Order::where('id', $order_id)->first();
            $order->status = 'Dalam Proses';
            $order->save();
        }

        return redirect()->back()->with('message', 'Transaksi berhasil divalidasi!');
    }

    public function rejected(Request $request)
    {
        // request order id
        $order_id = $request->order_id;

        // update status
        $transaction = Transaction::where('order_id', $order_id)->first();
        $transaction->status = 'rejected';
        $transaction->save();

        if ($transaction) {
            // Update status order by order_id
            $order = Order::where('id', $order_id)->first();
            $order->status = 'Pesanan Gagal';
            $order->save();

            // Update stock of products in the order
            foreach ($order->orderDetails as $orderDetail) {
                $product = Product::findOrFail($orderDetail->product_id);
                $product->stock += $orderDetail->quantity;
                $product->save();
            }
        }

        return redirect()->back()->with('message', 'Transaksi berhasil ditolak!');
    }
}
