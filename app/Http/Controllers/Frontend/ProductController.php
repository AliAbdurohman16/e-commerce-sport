<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        // get data where slug
        $products = Product::with(['images', 'discounts'])->latest()->paginate(8);

        return view('frontend.products.index', compact('products'));
    }

    public function show($slug)
    {
        // get data where slug
        $product = Product::with(['images', 'discounts'])->where('slug', $slug)->firstOrFail();

        // get related products
        $relatedProducts = Product::with(['images', 'discounts'])
                            ->where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->take(10)
                            ->get();

        return view('frontend.products.detail', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        // get user's search input
        $search = $request->key;

        // retrieve products that match the search input
        $products = Product::with(['images', 'discounts'])
                    ->where('name', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%")
                    ->paginate(8);

        return view('frontend.search.index', compact('products', 'search'));
    }

    public function discount()
    {
        // get data where slug
        $products = Product::with(['images', 'discounts'])
                    ->whereHas('discounts', function ($query) {
                        $query->where('start_date', '<=', now())
                            ->where('end_date', '>=', now());
                    })
                    ->latest()
                    ->paginate(8);

        return view('frontend.products.discount', compact('products'));
    }

    public function addToCart(Request $request, $id)
    {
        // get the currently logged in user
        $user = $request->user();

        // if the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect('login');
        }

        // validation
        $request->validate([
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|gt:0',
        ]);

        // get product data
        $product = Product::findOrFail($id);

        // find or create order
        $order = Order::firstOrCreate([
            'user_id' => $user->id,
        ]);

        // find existing order detail with the same product, size, and color
        $orderDetail = $order->orderDetails()
                        ->where('product_id', $product->id)
                        ->where('size', $request->size)
                        ->where('color', $request->color)
                        ->first();

        // if order detail exists, update the quantity
        if ($orderDetail) {
            $orderDetail->quantity += $request->quantity;
            $orderDetail->save();
        } else {
            // create new order detail
            $orderDetail = new OrderDetail([
                // 'order_id' => $order->id,
                'product_id' => $product->id,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity
            ]);

            $order->orderDetails()->save($orderDetail);
        }

        return redirect('carts')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }
}
