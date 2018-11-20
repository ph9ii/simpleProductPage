<?php

namespace App\Http\Controllers;

use File;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(15);

        return view('shop.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:0'
        ]);

        $product = Product::create([
            'title' => $request->title,
            'seller_id' => auth()->id(),
            'slug' => str_slug($request->title),
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        $product['total'] = $product['price'] * $product['quantity'];

        $product->save();

        File::put(storage_path().'/form.xml', $product);

        return redirect()->back()->with('success','Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // return view('shop.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
