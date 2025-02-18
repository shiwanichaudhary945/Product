<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    function postIndex() {

       // $products = Product::all();

        //return view("frontend.product.table",['products'=>$products]);

    }

    function edit($id) {

       $products=Product::find($id);
       return view("frontend.product.edit",['products'=>$products]);


    }

    function destroy($id) {

        $products=Product::find($id);
        $products->delete();
        return back()->withSuccess("product deleted sucessfully");

    }

    public function update(Request $request)
    {

        $products=Product::find($request->product_id);
        $products->name=$request->productName;
        $products->description=$request->productDescription;
        $products->price=$request->price;
        $products->product_code=$request->productCode;

        if ($request->hasFile('productImage')) {
            $file = $request->file('productImage');
            $imageName = time(). $file->getClientOriginalName();
            $file->move(public_path('products'), $imageName);
            $products->image = 'products/' . $imageName;
        }

        $products->update();
        return redirect()->route('product.index')->withSuccess("Product Image updated successfully.");

    }



}
