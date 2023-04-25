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
            $query->where('user_id', Auth::user()->id);
        })->get();

        return view('frontend.cart.index', compact('order_details'));
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
