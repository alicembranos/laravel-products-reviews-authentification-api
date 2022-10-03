<?php

namespace App\Http\Controllers;

use App\Http\Middleware\StatisticMiddleware;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware(StatisticMiddleware::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5'
        ]);

        $review = new Review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = $request->user()->id;

        $product->reviews()->save($review);
        return response()->json(['message' => 'REview Added', 'review' => $review]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Review $review)
    {
        if ($request->user()->id !== $review->user_id) {
            return response()->json(['message' => 'Action Forbidden']);
        }

        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->update();

        return response()->json(['message' => 'Review Updated', 'review' => $review]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {
        if (auth()->user()->id !== $review->user_id) {
            return response()->json(['message' => 'Action Forbidden']);
        }
        $review->delete();
        return response()->json(['message' => 'Review deleted'], 204);
    }
}
