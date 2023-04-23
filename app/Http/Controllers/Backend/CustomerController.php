<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        // get data
        $customers = User::whereDoesntHave('roles', function ($query) {
                        $query->where('name', '=', 'admin');
                    })->get();

        return view('backend.customer.index', compact('customers'));
    }
}
