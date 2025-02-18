<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('user')->get(); // Fetch products with user relationship
        $creatorName = Auth::user()->name; // Get the authenticated user's name
        return view('frontend.product.table', ['products' => $products, 'creatorName' => $creatorName]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("frontend.product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "productName" => "required",
            "productDescription" => "required",
            "price" => "required",
            "productCode" => "required",
            "productImage" => "required"
        ]);

        $product = new Product;
        $product->name = $request->productName;
        $product->description = $request->productDescription;
        $product->price = $request->price;
        $product->product_code = $request->productCode;
        $product->user_id = Auth::id();

        if ($request->hasFile('productImage')) {
            $file = $request->file('productImage');
            $imageName = time(). $file->getClientOriginalName();
            $file->move(public_path('products'), $imageName);
            $product->image = 'products/' . $imageName;
        }

        $product->save();

        return redirect()->route('product.index')->withSuccess("Product created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('user'); // Eager load the 'user' relationship
        $creatorName = $product->user->name; // Get the creator's name

        return view('frontend.product.save', [
            'product' => $product,
            'creatorName' => $creatorName,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
       // You can implement edit functionality here if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // You can implement update functionality here if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // You can implement delete functionality here if needed
    }

    /*public function Product(){

        $product=Product::all();

        if(isset($product))
        {
            return response()->json([
                'product'=>$product
            ]);
        }
        else{
            return response()->json([
                'error'=>'data not found',
            ]);
        }

    }
        */
}
