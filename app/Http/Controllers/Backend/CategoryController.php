<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // get data
        $categories = Category::all();

        return view('backend.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
        ]);

        // process upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/categories');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        // insert to table categories
        Category::create([
            'image' => $imageName,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->back()->with('message', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // validation
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|max:255',
        ]);

        // get data find or fail by id
        $category = Category::findOrFail($id);

        // process upload image
        if ($request->hasFile('image')) {
            Storage::delete('public/categories/' . $category->image);
            $imagePath = $request->file('image')->store('public/categories');
            $imageName = basename($imagePath);
        } else {
            $imageName = $category->image;
        }

        // update to table categories
        $category->update([
            'image' => $imageName,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->back()->with('message', 'Kategori berhasil diubah!');
    }

    public function destroy($id)
    {
        // get data find or fail by id
        $category = Category::findOrFail($id);

        // process delete image
        if ($category->image) {
            Storage::delete('public/categories/' . $category->image);
        }

        // delete data
        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus!']);
    }
}
