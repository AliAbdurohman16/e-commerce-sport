<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        return view('backend.report.index');
    }

    public function data(Request $request)
    {
        // get request data
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // get transactions data
        $transactions = Transaction::with(['user', 'order'])
                                    ->when($start_date, function ($query) use ($start_date) {
                                        return $query->whereDate('updated_at', '>=', $start_date);
                                    })
                                    ->when($end_date, function ($query) use ($end_date) {
                                        return $query->whereDate('updated_at', '<=', $end_date);
                                    })
                                    ->where('status', 'success')
                                    ->get();

        return view('backend.report.data', compact('transactions', 'start_date', 'end_date'));
    }
}
