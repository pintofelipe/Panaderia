<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;



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
        $productoCount = Product::where('status','=','1')->count();
        $clientCount = Client::where('status','=','1')->count();
        $date = Carbon::now();  
        $date = $date->format('Y-m-d');


       
        $orderCountDay = Order::whereDate('date_order','=', Carbon::now()->format('Y-m-d'))->get()->count("id");
        $orderTotalDay = Order::whereDate('date_order','=' ,Carbon::now()->format('Y-m-d'))->get()->sum("total");


        $orderCountMonth = Order::whereMonth('date_order',date('m'))->get()->count("id");
        $orderTotalMonth = Order::whereMonth('date_order',date('m'))->get()->sum("total");



        
        return view('home', compact('productoCount','clientCount','orderCountDay','orderTotalDay','orderCountMonth','orderTotalMonth'));
    }
}
