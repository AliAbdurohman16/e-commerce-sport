<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // get transaction data
        $transactions = Transaction::all();

        return view('backend.transaction.index', compact('transactions'));
    }
}
