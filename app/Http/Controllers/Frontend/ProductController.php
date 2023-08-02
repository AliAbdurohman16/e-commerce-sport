<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        // get data
        $products = Product::with(['images', 'discounts'])->latest()->paginate(8);

        // get data rating
        $ratings = Review::select('product_id', 'rating')
                            ->selectRaw('COUNT(*) as total')
                            ->groupBy('product_id', 'rating')
                            ->orderByDesc('total')
                            ->orderByDesc('rating')
                            ->get();

        // mapping rating data into associative arrays based on product_id
        $ratingsByProductId = [];
        foreach ($ratings as $rating) {
            $productId = $rating->product_id;
            if (!isset($ratingsByProductId[$productId])) {
                $ratingsByProductId[$productId] = ['rating' => $rating->rating, 'total' => $rating->total];
            }
        }

        // dd($ratingsByProductId);

        return view('frontend.products.index', compact('products', 'ratingsByProductId'));
    }

    public function show($slug)
    {
        // get the currently logged in user
        $user = Auth::user();

        // if the user is not logged in, redirect to the login page
        if (!$user) {
            return redirect('login');
        }

        // get data where slug
        $product = Product::with(['images', 'discounts'])->where('slug', $slug)->firstOrFail();

        // get data rating
        $rating = Review::select('rating')
                        ->selectRaw('COUNT(*) as total')
                        ->where('product_id', $product->id)
                        ->groupBy('rating')
                        ->orderByDesc('total')
                        ->first();

        // get data review
        $reviews = Review::where('product_id', $product->id)->get();

        // get related products
        $relatedProducts = Product::with(['images', 'discounts'])
                            ->where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->take(10)
                            ->get();

        // get the currently logged in user
        $user = Auth::user();

        // find or create order
        $order = Order::where('user_id', $user->id)
                        ->where('status', 'Belum Checkout')
                        ->first();

        return view('frontend.products.detail', compact('product', 'rating', 'reviews', 'relatedProducts', 'order'));
    }

    public function search(Request $request)
    {
        // get user's search input
        $search = $request->key;

        // retrieve products that match the search input
        $products = Product::with(['images', 'discounts'])
                            ->where(function ($query) use ($search) {
                                $query->where('name', 'LIKE', "%$search%")
                                    ->orWhere('description', 'LIKE', "%$search%")
                                    ->orWhereHas('category', function ($query) use ($search) {
                                        $query->where('name', 'LIKE', "%$search%")
                                            ->orWhere('slug', 'LIKE', "%$search%");
                                    });
                            })
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

        // get data rating
        $ratings = Review::select('product_id', 'rating')
                        ->selectRaw('COUNT(*) as total')
                        ->groupBy('product_id', 'rating')
                        ->orderByDesc('total')
                        ->orderByDesc('rating')
                        ->get();

        // mapping rating data into associative arrays based on product_id
        $ratingsByProductId = [];
        foreach ($ratings as $rating) {
            $productId = $rating->product_id;
            if (!isset($ratingsByProductId[$productId])) {
                $ratingsByProductId[$productId] = ['rating' => $rating->rating, 'total' => $rating->total];
            }
        }

        return view('frontend.products.discount', compact('products', 'ratingsByProductId'));
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
        $order = Order::where('id', $request->order_id)
                        ->where('user_id', $user->id)
                        ->where('status', 'Belum Checkout')
                        ->first();

        if (!$order) {
            // do something if order is not exist create new order
            $order = new Order([
                'id' => $request->order_id,
                'user_id' => $user->id,
            ]);

            $order->save();
            $order->refresh();
        }


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
                'order_id' => $order->id,
                'product_id' => $product->id,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity
            ]);

            $orderDetail->save();
        }

        return redirect('carts')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }
}
