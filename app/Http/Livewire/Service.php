<?php

namespace App\Http\Livewire;

use App\Models\Service as ServiceModel;
use Livewire\Component;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\ValidationException;

class Service extends Component
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = ServiceModel::all();
        $array = [];
        foreach ($services as $service) {
            $array [] = [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
                'clients' => $service->clients,
            ];
        }
        
        return response()->json($array);
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

        try {
            $service = new ServiceModel;
            $service->name = $request->name;
            $service->description = $request->description;
            $service->price = $request->price;
            $service->save();
            $data = [
                'message' => 'Service create successfully',
                'service' => $service,
            ];
            return response()->json($data);

        } catch (ValidationException $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        } catch (\Exception $exception) {
            throw new HttpException(500, "Internal Server Error");
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceModel $service)
    {
        return response()->json($service);
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
    public function update(Request $request, ServiceModel $service)
    {
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        $data = [
            'message' => 'Service create successfully',
            'service' => $service,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceModel $service)
    {
        $service->delete();
        $data = [
            'message' => 'Client delete successfully',
            'service' => $service,
        ];
        return response()->json($data);
    }

    public function clients(Request $request)
    {
        $service = ServiceModel::find($request->service_id);
        $clients = $service->clients;
        $data = [
            'message' => 'Service details',
            'clients' => $clients,
        ];
        return response()->json($data);
    }
}
