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
                                    ->where('status', '!=', 'pending')
                                    ->get();

        // pluck order id
        $transactions->pluck('order_id');

        return view('frontend.histories.index', compact('transactions'));
    }

    public function payment()
    {
        // get the currently logged in user
        $user = Auth::user();

        // get data transaction
        $transactions = Transaction::where('user_id', $user->id)->get();

        return view('frontend.histories.payment', compact('transactions'));
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
