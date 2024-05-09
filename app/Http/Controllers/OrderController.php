<?php

namespace App\Http\Controllers;

use Illuminate\Http\OrderRequest;
use App\Models\User;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



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
    
        $fecha = Carbon ::now();
        $fecha = $fecha->format('Y-m-d');

        return view('orders.create', compact('clients','products','fecha'));
    }

    
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        try {

            $order = new Order();
            $order->client_id = $request->client_id;
            $order->dateOrder = $request->client_dateOrder;
            $order->total = $request->total;
            $order->status = 1;
            $order->registered_by = $request->user()->id;
            $order->route = $request->route;
            $order = $order->save();

            $idorder = $order->id;

            $count=0;
            while($count < count($idorder)) {
                

                $detailOrder ->save();
                $count++;
            }



        } catch (\Exception $e) {
            return redirect()->back()->with('SuccessMsg','Error al registrar la informacion');
        }
        
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

   
    public function update(OrderRequest $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
