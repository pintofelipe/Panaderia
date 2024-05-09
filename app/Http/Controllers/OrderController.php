<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Order;



use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("orders.index", compact("orders"));
    }

   
    public function create()
    {
        $clients = Client::where("status", '=', '1' )->orderBy('name')->get();
        $products = Product::where("status", '=', '1' )->orderBy('name')->get();
    
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
