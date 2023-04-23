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

    public function create()
    {
        return view('backend.customer.add');
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|max:255',
            'telephone' => 'required|max:15',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'address' => 'required',
        ]);

        // insert to tabel users
        User::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ]);

        return redirect('customers')->with('message', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // find data by id
        $customer = User::findOrFail($id);

        return view('backend.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // find data by id
        $customer = User::findOrFail($id);

        // check if email unique the user email
        if ($customer->email == $request->email) {
            $rules_email = 'required|email';
        } else {
            $rules_email = 'required|email|unique:users';
        }

        // // check if the user password
        if ($request->password) {
            $rules_password = 'required|min:8|confirmed';
        } else {
            $rules_password = '';
        }

        // validation
        $request->validate([
            'name' => 'required|max:255',
            'telephone' => 'required|max:15',
            'email' => $rules_email,
            'password' => $rules_password,
            'address' => 'required',
        ]);

        // update to table
        $customer->update([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $customer->password,
            'address' => $request->address,
        ]);

        return redirect('customers')->with('message', 'Pelanggan berhasil diubah!');
    }

    public function destroy($id)
    {
        // find data by id
        $customer = User::findOrFail($id);

        // delete data
        $customer->delete();

        return response()->json(['message' => 'Pelanggan berhasil dihapus!']);
    }
}
