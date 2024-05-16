<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Http\Requests\ClientRequest;

use App\Models\Client;

class ClientController extends Controller





{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view("clients.index", compact("clients"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("clients.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $ClientRequest)
    {
        $image = $ClientRequest->file('photo');
        $slug = str::slug($ClientRequest->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $photoName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/clients')) {
                mkdir('uploads/clients', 0777, true);
            }
            $image->move('uploads/clients', $photoName);
        } else {
            $photoName = "";
        }

        $product = new Client();
        $product->name = $ClientRequest->name;
        $product->document = $ClientRequest->document;
        $product->photo = $photoName;
        $product->address = $ClientRequest->address;
        $product->city = $ClientRequest->city;
        $product->phone = $ClientRequest->phone;
        $product->email = $ClientRequest->email;
        $product->status = 1;
        $product->registered_by = $ClientRequest->user()->id;
        $product->save();

        return redirect()->route("clients.index")->with("success", "Client successfully added.");
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
        $client = Client::find($id);
        return view("clients.edit", compact("client"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $ClientRequest, string $id)
    {
        $client = Client::find($id);

        $image = $ClientRequest->file('photo');
        $slug = str::slug($ClientRequest->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $photoName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/clients')) {
                mkdir('uploads/clients', 0777, true);
            }
            $image->move('uploads/clients', $photoName);
        } else {
            $photoName = "";
        }

        $client->name = $ClientRequest->name;
        $client->document = $ClientRequest->document;
        $client->photo = $photoName;
        $client->address = $ClientRequest->address;
        $client->city = $ClientRequest->city;
        $client->phone = $ClientRequest->phone;
        $client->email = $ClientRequest->email;
        $client->status = 1;
        $client->registered_by = $ClientRequest->user()->id;
        $client->save();

        return redirect()->route("clients.index")->with("success", "Client successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route("clients.index")->with("success", "The product has been deleted.");
    }

    public function changeclienturl(ClientRequest $ClientRequest)
    {
        $product = Client::find($ClientRequest->client_id);
        $product->status = $ClientRequest->status;
        $product->save();
    }
}