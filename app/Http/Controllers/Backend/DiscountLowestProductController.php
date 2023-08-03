<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\OrderDetail;
use App\Models\User;
use App\Notifications\DiscountNotification;
use Illuminate\Support\Facades\Notification;

class DiscountLowestProductController extends Controller
{
    public function index()
    {
        // get data
        $discounts = Discount::where('type', 'Kurang Laris')->get();

        return view('backend.discounts.lowest.index', compact('discounts'));
    }

    public function create()
    {
        // get all data products
        $orders = OrderDetail::selectRaw('product_id, SUM(quantity) as total')
                                ->whereHas('order', function ($query) {
                                    $query->whereNotIn('status', ['Belum Checkout', 'Sudah Bayar', 'Dibatalkan']);
                                })
                                ->groupBy('product_id')
                                ->orderBy('total', 'asc')
                                ->take(5)
                                ->get();
        // dd($orders->product);

        return view('backend.discounts.lowest.add', compact('orders'));
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'product' => 'required',
            'discount_percentage' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // insert to table discounts
        $discount = Discount::create([
            'product_id' => $request->product,
            'discount_percentage' => $request->discount_percentage,
            'type' => 'Kurang Laris',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $users = User::whereDoesntHave('roles', function ($query) {
                        $query->where('name', '=', 'admin');
                    })->get();

        Notification::send($users, new DiscountNotification($discount));

        return redirect('discounts-lowest-product')->with('message', 'Diskon berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // get data find or fail by id
        $discounts = Discount::findOrFail($id);

        // get all data products
        $orders = OrderDetail::selectRaw('product_id, SUM(quantity) as total')
                                ->whereHas('order', function ($query) {
                                    $query->whereNotIn('status', ['Belum Checkout', 'Sudah Bayar', 'Dibatalkan']);
                                })
                                ->groupBy('product_id')
                                ->orderBy('total', 'asc')
                                ->take(5)
                                ->get();

        return view('backend.discounts.lowest.edit', compact('discounts', 'orders'));
    }

    public function update(Request $request, $id)
    {
        // validation
        $request->validate([
            'product' => 'required',
            'discount_percentage' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // get data find or fail by id
        $discount = Discount::findOrFail($id);

        // insert to table discounts
        $discount->update([
            'product_id' => $request->product,
            'discount_percentage' => $request->discount_percentage,
            'type' => 'Kurang Laris',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect('discounts-lowest-product')->with('message', 'Diskon berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data find or fail by id
        $discount = Discount::findOrFail($id);

        // delete data
        $discount->delete();

        return response()->json(['message' => 'Diskon berhasil dihapus!']);
    }
}
