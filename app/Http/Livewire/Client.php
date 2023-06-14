<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Client as ClientModel;

class Client extends Component
{
    public function index()
    {
        $clients = ClientModel::all();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $client = new Client;

    }
    
    public function render()
    {
        return view('livewire.client');
    }
}
