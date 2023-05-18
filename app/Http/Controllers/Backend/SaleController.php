<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class SaleController extends Controller
{
    public function index()
    {
        // get transactions data
        $sales = Transaction::with(['user', 'order'])
                                    ->where('status', 'success')
                                    ->get();

        return view('backend.sales.index', compact('sales'));
    }
}
