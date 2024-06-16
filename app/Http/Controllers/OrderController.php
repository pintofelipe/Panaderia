<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use \Exception;

use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('orders.create', compact('clients', "products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        try {
            $order = Order::create([
                'date_order' => Carbon::now()->toDateTimeString(),
                'total' => $request->total,
                'route' => "Por hacer",
                'client_id' => Client::find($request->client)->id,
                'status' => 1,
                'registered_by' => $request->registered_by
            ]);

            $rawProductId = $request->product_id;
            $rawQuantity = $request->quantity;

            for ($i = 0; $i < count($rawProductId); $i++) {
                $product = Product::find($rawProductId[$i]);
                $quantity = $rawQuantity[$i];

                $order->orderDetails()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }

            $order->save();

            // Generate bill (PDF).
            $pdfName = 'uploads/bills/bill_' . $order->id . '_' . Carbon::now()->format('YmdHis') . '.pdf';

            $order = Order::find($order->id);
            $client = Client::where("id", $order->client_id)->first();
            $details = OrderDetail::with('product')
                ->where('order_details.order_id', '=', $order->id)
                ->get();

            $pdf = PDF::loadView('orders.bill', compact("order", "client", "details"))
                ->setPaper('letter')
                ->output();

            file_put_contents($pdfName, $pdf);

            $order->route = $pdfName;
            $order->save();

            DB::commit();

            return redirect()->route("orders.index")->with("success", "The orders has been created.");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("success", $e->getMessage());
        }
    }


    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        $client = Client::where("id", $order->client_id)->first();
        $details = OrderDetail::with('product')
            ->where('order_details.order_id', '=', $id)
            ->get();

        return view("orders.show", compact("order", "client", "details"));
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
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route("orders.index")->with("success", "The order has been deleted.");
    }

    public function changeorderurl(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();
    }
}