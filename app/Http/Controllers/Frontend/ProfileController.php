<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('frontend.account.profile', compact('user'));
    }

    public function store(Request $request)
    {
        // get data
        $user = Auth::user();

        // check if email unique the user email
        if ($user->email == $request->email) {
            $rules = 'required|email';
        } else {
            $rules = 'required|email|unique:users';
        }

        // checking image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/users');

            if ($user->image != 'default/user.png') {
                Storage::delete('public/users/' . $user->image);
            }

            $imageName = basename($imagePath);
        } else {
            $imageName = $user->image;
        }

        // validation
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'name' => 'required',
            'telephone' => 'required',
            'email' => $rules,
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'postal_code' => 'required',
        ]);

        // update to table
        $user->update([
            'image' => $imageName,
            'name' => $request->name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'subdistrict' => $request->subdistrict,
            'village' => $request->village,
            'postal_code' => $request->postal_code,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah!');
    }
}
