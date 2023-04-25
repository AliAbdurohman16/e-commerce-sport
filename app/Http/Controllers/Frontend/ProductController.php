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
        $search = $request->input('key');

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
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // validation
        $request->validate([
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|gt:0',
        ]);

        // create or search for unfinished orders
        // $order = Order::where('user_id', $user->id)
        //     ->where('status', 'Belum Checkout')
        //     ->first();

        // get product data
        $product = Product::findOrFail($id);

        // get product price after discount (if any)
        if ($product->discounts->count() > 0) {
            $discount = $product->discounts->first()->discount_percentage;
            $price = $product->price - ($product->price * ($discount / 100));
        } else {
            $price = $product->price;
        }

        // get the number of items to add to cart
        $quantity = $request->input('quantity');

        // calculates subtotals
        $subtotal = $price * $quantity;

        // if the order already exists, then increase the amount
        // if ($order) {
        //     $amount = $order->amount + $subtotal;
        //     $order->update(['amount' => $amount]);
        // } else {
        //     $order = new Order([
        //         'user_id' => $user->id,
        //         'amount' => 0,
        //     ]);
        //     $order->save();
        // }

        $order = new Order([
            'user_id' => $user->id,
        ]);
        $order->save();

        // add order details
        $orderDetail = new OrderDetail([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'size' => $request->input('size'),
            'color' => $request->input('color'),
            'quantity' => $quantity,
            'price' => $price,
        ]);
        $orderDetail->save();

        return redirect('carts')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }
}
