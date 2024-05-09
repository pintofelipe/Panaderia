<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("products.index", compact("products"));
    }


    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $image = $request->file('image');
        $slug = str::slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/products')) {
                mkdir('uploads/products', 0777, true);
            }
            $image->move('uploads/products', $imagename);
        } else {
            $imagename = "";
        }


        $product = new Product();
        $product->name = $request->name;
        $product->image = $imagename;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = 1;
        $product->registered_by = $request->user()->id;
        $product->save();


        return redirect()->route("products.index")->with("success", "Product successfully added.");
    }


    public function show(string $id)
    {

    }


    public function edit(string $id)
    {
        $product = Product::find($id);
        return view("products.edit", compact("product"));
    }


    public function update(Request $request, string $id)
    {
        //

        $product = Product::find($id);

        $image = $request->file('image');
        $slug = str::slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/products')) {
                mkdir('uploads/products', 0777, true);
            }
            $image->move('uploads/products', $imagename);
        } else {
            $imagename = $product->image;
        }

        
        $product->name = $request->name;
        $product->image = $imagename;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->registered_by = $request->user()->id;
        $product->save();

        return redirect()->route('products.index')->with('successMsg','El registro se actualizó exitosamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route("products.index")->with("success", "The product has been deleted.");
    }

    public function changeproducturl(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
    }
}