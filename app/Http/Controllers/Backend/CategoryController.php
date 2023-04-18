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
        $categories = Category::all();

        return view('backend.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/categories');
            $imageName = basename($imagePath);
        } else {
            $imageName = '';
        }

        Category::create([
            'image' => $imageName,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->back()->with('message', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/categories/' . $category->image);
            $imagePath = $request->file('image')->store('public/categories');
            $imageName = basename($imagePath);
        } else {
            $imageName = $category->image;
        }

        $category->update([
            'image' => $imageName,
            'name' => $request->name,
            'slug'  => Str::slug($request->name, '-')
        ]);

        return redirect()->back()->with('message', 'Kategori berhasil diubah!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            Storage::delete('public/categories/' . $category->image);
        }

        $category->delete();

        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
