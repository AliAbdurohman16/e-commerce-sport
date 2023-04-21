<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;

class DiscountController extends Controller
{
    public function index()
    {
        // get data
        $discounts = Discount::all();

        return view('backend.discounts.index', compact('discounts'));
    }

    public function create()
    {
        // get data discount
        $discounts = Discount::all();

        // get all data products
        $products = Product::all();

        return view('backend.discounts.add', compact('discounts', 'products'));
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
        Discount::create([
            'product_id' => $request->product,
            'discount_percentage' => $request->discount_percentage,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect('discounts')->with('message', 'Diskon berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // get data find or fail by id
        $discounts = Discount::findOrFail($id);

        // get all data products
        $products = Product::all();

        return view('backend.discounts.edit', compact('discounts', 'products'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
