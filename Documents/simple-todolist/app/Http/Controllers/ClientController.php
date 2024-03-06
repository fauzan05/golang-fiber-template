<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        Client::create([
            'client_id' => $request->client_id,
            'name' => $request->name,
            'secret' => $request->secret,
            'redirect_url' => $request->redirect_url
        ]);
    }

    public function show()
    {
        $response = Client::all();
        return response()->json(['data' => $response]);
    }

    public function update(int $id, Request $request)
    {
        Client::where('id', $id)->update([
            'client_id' => $request->client_id,
            'name' => $request->name,
            'secret' => $request->secret,
            'redirect_url' => $request->redirect_url
        ]);

    }

    public function delete(int $id)
    {
        Client::find($id)->delete();
        $response = Client::all();
        return response()->json(['data' => $response]);
    }
}
