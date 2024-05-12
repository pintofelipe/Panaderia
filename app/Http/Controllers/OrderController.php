<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::select('clients.name', 'clients.document', 'orders.order_detail_id', 'orders.id', 'orders.total', 'orders.date_order')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('orders.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->date_order = Carbon::now()->toDateTimeString();
        $order->total = 0;
        $order->route = "Por hacer";
        $order->status = $request->status;
        $order->registered_by = $request->registered_by;
        $order->client_id = Client::find($request->client)->id;

        $orderDetail = new OrderDetail();
        $orderDetail->quantity = 0;
        $orderDetail->subtotal = 0;
        $orderDetail->product_id = Product::find(2)->id; // TODO: Remove hardcode.
        $orderDetail->save();

        $order->order_detail_id = $orderDetail->id;

        $order->save();

        return redirect()->route("orders.index")->with("success", "The orders has been created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}