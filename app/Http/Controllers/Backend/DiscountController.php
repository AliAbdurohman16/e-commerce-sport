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

    public function store(Request $request)
    {
        //
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
