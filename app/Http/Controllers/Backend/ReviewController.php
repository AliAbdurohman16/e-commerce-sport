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
        // get data
        $ratingFive = Review::selectRaw('product_id, Count(rating) as total')->where('rating', '5')->groupBy('product_id')->get();
        $ratingFour = Review::selectRaw('product_id, Count(rating) as total')->where('rating', '4')->groupBy('product_id')->get();
        $ratingThree = Review::selectRaw('product_id, Count(rating) as total')->where('rating', '3')->groupBy('product_id')->get();
        $ratingTwo = Review::selectRaw('product_id, Count(rating) as total')->where('rating', '2')->groupBy('product_id')->get();
        $ratingOne = Review::selectRaw('product_id, Count(rating) as total')->where('rating', '1')->groupBy('product_id')->get();

        // create chart data to json
        $data = [
            'ratingFiveData' => $ratingFive->pluck('total')->toJson(),
            'ratingFiveLabels' => $ratingFive->pluck('product.name')->toJson(),
            'ratingFourData' => $ratingFour->pluck('total')->toJson(),
            'ratingFourLabels' => $ratingFour->pluck('product.name')->toJson(),
            'ratingThreeData' => $ratingThree->pluck('total')->toJson(),
            'ratingThreeLabels' => $ratingThree->pluck('product.name')->toJson(),
            'ratingTwoData' => $ratingTwo->pluck('total')->toJson(),
            'ratingTwoLabels' => $ratingTwo->pluck('product.name')->toJson(),
            'ratingOneData' => $ratingOne->pluck('total')->toJson(),
            'ratingOneLabels' => $ratingOne->pluck('product.name')->toJson(),
        ];

        // dd($data);

        return view('backend.reviews.chart', $data);
    }
}
