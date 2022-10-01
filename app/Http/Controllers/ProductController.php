<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('user:id,name')
            ->withCount('reviews')
            ->latest()
            ->paginate(10);

        return response()->json(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price_in_cents' => 'required|numeric|min:0'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price_in_cents = $request->price_in_cents;
        $product->user_id = $request->user()->id;
        $product->save();

        $request->user()->products()->save($product);
        return response()->json(['message' => 'Product Added', 'product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['reviews' => function ($query) {
            $query->latest();
        }, 'user']);

        return response()->json(['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price_in_cents' => 'required|numeric|min:0'
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price_in_cents = $request->price_in_cents;
        $product->user_id = $request->user()->id;
        $product->update();

        return response()->json(['message' => 'Product Updated', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted'], 204);
    }
}
