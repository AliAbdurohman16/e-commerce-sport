<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        return view('backend.reviews.index', compact('reviews'));
    }

    public function chart()
    {
        $reviews = Review::all();

        return view('backend.reviews.chart', compact('reviews'));
    }
}
