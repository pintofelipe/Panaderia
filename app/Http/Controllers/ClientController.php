<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support;
use Carbon\Carbon;
use Illuminate\Support\Str;



class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view("clients.index", compact("clients"));
    }


    public function create()
    {
        return view('clients.create');
    }


    public function store(Request $request)
    {
        $image = $request->file('image');
        $slug = str::slug($request->nombre);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/clients')) {
                mkdir('uploads/clients', 0777, true);
            }
            $image->move('uploads/clients', $imagename);
        } else {
            $imagename = "";
        }



        $client = new Client();
        $client->name = $request->name;
        $client->image = $imagename;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->document = $request->document;
        $client->status = 1;
        $client->registered_by = $request->user()->id;
        $client->save();


        return redirect()->route("clients.index")->with("success", "Client successfully added.");
    }


    public function show(string $id)
    {

    }


    public function edit(Client $client)
    {
        return view("clients.edit", compact("client"));
    }


    public function update(Request $request, string $id)
    {

        $client = Client::find($id);

        $image = $request->file('image');
        $slug = str::slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/clients')) {
                mkdir('uploads/clients', 0777, true);
            }
            $image->move('uploads/clients', $imagename);
        } else {
            $imagename = $client->image;
        }

        $client->name = $request->name;
        $client->image = $imagename;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->document = $request->document;
        $client->status = 1;
        $client->registered_by = $request->user()->id;
        $client->save();

        return redirect()->route('clients.index')->with('successMsg','El registro se actualizó exitosamente');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('eliminar', 'ok');
    }

    public function cambioestadoarl(Client $client)
    {
        $arl = Client::find($client->client_id);
        $arl->estatus = $client->estatus;
        $arl->save();
    }
}