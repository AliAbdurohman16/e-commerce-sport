<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // get the currently logged in user
        $user = Auth::user();

        // get data transaction
        $transactions = Transaction::where('user_id', $user->id)
                                    ->where('status', '!=', 'belum bayar')
                                    ->where('status', '!=', 'pending')
                                    ->get();

        // pluck order id
        $transactions->pluck('order_id');

        return view('frontend.histories.index', compact('transactions'));
    }

    public function paymentHistory()
    {
        // get the currently logged in user
        $user = Auth::user();

        // get data transaction
        $transactions = Transaction::where('user_id', $user->id)->get();

        return view('frontend.histories.payment-history', compact('transactions'));
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

    public function review(Request $request,$id)
    {
        // get data
        $order_id = $request->order_id;
        $orderDetails = OrderDetail::where('product_id', $id)->where('order_id', $order_id)->where('review', null)->first();

        // get the currently logged in user
        $user = Auth::user();

        // insert to table review
        Review::create([
            'product_id' => $id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // update to table order details
        $orderDetails->review = 'done';
        $orderDetails->save();

        return response()->json(['message' => 'Terima kasih atas penilaiannya!']);
    }
}
