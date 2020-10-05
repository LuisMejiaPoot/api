<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceos = Clients::all();
        return response([ 'clients' => ClientsResource::collection($ceos), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'year' => 'required|max:255',
            'company_headquarters' => 'required|max:255',
            'what_company_does' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $clients = Clients::create($data);

        return response([ 'clients' => new ClientsResource($clients), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CEO  $ceo
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $clients)
    {
        return response([ 'clients' => new ClientsResource($clients), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CEO  $ceo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $clients)
    {

        $clients->update($request->all());

        return response([ 'clients' => new ClientsResource($clients), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\CEO $ceo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Clients $clients)
    {
        $clients->delete();

        return response(['message' => 'Deleted']);
    }
}