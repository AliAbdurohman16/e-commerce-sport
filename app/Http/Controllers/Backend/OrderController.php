<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Shipping;

class OrderController extends Controller
{
    public function index()
    {
        // get order details data with order
        $orderDetails = OrderDetail::with(['order.user', 'shippings', 'transactions'])
                                    ->whereHas('order', function ($query) {
                                        $query->where('status', 'Dalam Proses');
                                    })
                                    ->get();

        return view('backend.orders.index', compact('orderDetails'));
    }

    public function store(Request $request)
    {
        // update status order
        $order_id = $request->order_id;
        $order = Order::where('id', $order_id);
        $order->update(['status' => 'Dalam Pengiriman']);

        // insert shipping data
        $shipping = Shipping::where('order_id', $order_id);
        $shipping->update([
            'resi' => $request->resi,
            'provider' => $request->provider,
            'estimation' => now()->addDays(5),
        ]);

        return redirect()->back()->with('message', 'Data orderan berhasil ditambahkan ke data orderan dikirim!');
    }

    public function sent()
    {
        // get order details data with order
        $orderDetails = OrderDetail::with(['order.user', 'shippings', 'transactions'])
                                    ->whereHas('order', function ($query) {
                                        $query->where('status', 'Dalam Pengiriman');
                                    })
                                    ->get();

        return view('backend.orders.order-sent', compact('orderDetails'));
    }

    public function received()
    {
        // get order details data with order
        $orderDetails = OrderDetail::with(['order.user', 'shippings', 'transactions'])
                                    ->whereHas('order', function ($query) {
                                        $query->where('status', 'Pesanan Diterima');
                                    })
                                    ->get();

        return view('backend.orders.order-received', compact('orderDetails'));
    }

    public function rejected()
    {
        // get order details data with order
        $orderDetails = OrderDetail::with(['order.user', 'shippings', 'transactions'])
                                    ->whereHas('order', function ($query) {
                                        $query->where('status', 'Pesanan Gagal');
                                    })
                                    ->get();

        return view('backend.orders.order-rejected', compact('orderDetails'));
    }

    public function invoice($order_id)
    {
        // get order details data with order
        $orderDetail = OrderDetail::with(['order.user', 'shippings', 'transactions'])
                                    ->whereHas('order', function ($query) use ($order_id) {
                                        $query->where('id', $order_id)
                                        ->where('status', 'Dalam Proses');
                                    })
                                    ->first();

        return view('backend.orders.invoice', compact('orderDetail'));
    }
}
