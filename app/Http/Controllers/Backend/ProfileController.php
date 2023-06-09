<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // get data
        $profile = Auth::user();

        return view('backend.profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        // get data
        $profile = Auth::user();

        // check if email unique the user email
        if ($profile->email == $request->email) {
            $rules = 'required|email';
        } else {
            $rules = 'required|email|unique:users';
        }

        // validation
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|image|max:2048',
            'name' => 'required',
            'telephone' => 'required',
            'email' => $rules,
            'address' => 'required',
        ]);

        // checking image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/users');

            if ($profile->image != 'default/user.png') {
                Storage::delete('public/users/' . $profile->image);
            }

            $imageName = basename($imagePath);
        } else {
            $imageName = $profile->image;
        }

        // update to table
        $profile->update([
            'image' => $imageName,
            'name' => $request->name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address
        ]);

        return redirect()->back()->with('message', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data
        $profile = Auth::user();

        // delete image
        if ($profile->image) {
            Storage::delete('public/users/' . $profile->image);
        }

        // update data
        $profile->update([
            'image' => 'default/user.png',
        ]);

        return redirect()->back()->with(['message' => 'Data berhasil dihapus!']);
    }
}
