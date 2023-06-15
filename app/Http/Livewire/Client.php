<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Client as ClientModel;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Client extends Component
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = ClientModel::all();
        $array = [];
        foreach ($clients as $client) {
            $array[] = [
                'id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
                'address' => $client->address,
                'services' => $client->services,
            ];
        }

        return response()->json($array);
        //return view('clients.clients')->with('clients', $array); //for view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new ClientModel;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
        $data = [
            'message' => 'Client create successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientModel $client)
    {
        $data = [
            'message' => 'Client details',
            'client' => $client,
            'services' => $client->services
        ];
        return response()->json($data);
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
    public function update(Request $request, ClientModel $client)
    {
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
        $data = [
            'message' => 'Client create successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientModel $client)
    {
        $client->delete();
        $data = [
            'message' => 'Client delete successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }

    public function attach(Request $request)
    {
        try {

            $client = ClientModel::find($request->client_id);
            $client->services()->attach($request->service_id);
            $data = [
                'message' => 'Service attached successfully',
                'client' => $client,
            ];
            return response()->json($data);

        } catch (ValidationException $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        } catch (\Exception $exception) {
            throw new HttpException(500, "Internal Server Error");
        }
        
    }

    public function detach(Request $request)
    {
        $client = ClientModel::find($request->client_id);
        $client->services()->detach($request->service_id);
        $data = [
            'message' => 'Service detach successfully',
            'client' => $client,
        ];
        return response()->json($data);
    }
}
