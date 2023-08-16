<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\OrderDetail;
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
            $order = OrderDetail::where('order_id', $order_id)->first();
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
            // Update status order details by order_id
            $orderDetail = OrderDetail::where('order_id', $order_id)->first();
            $orderDetail->status = 'Pesanan Gagal';
            $orderDetail->save();

            // Update stock of products in the order
            $product = Product::find($orderDetail->product_id);
            $product->stock += $orderDetail->quantity;
            $product->save();
        }

        return redirect()->back()->with('message', 'Transaksi berhasil ditolak!');
    }
}
