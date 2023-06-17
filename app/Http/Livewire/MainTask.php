<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;

class MainTask extends Component
{

    public $welcome = "Welcome, these are the tasks";

    protected $listeners = ['taskMessage'];

    public function taskMessage($message)
    {

        session()->flash('message', $message);
    }

    public function render()
    {
        return view('livewire.task.main-task',[
            'welcome' => $this->welcome,
        ]);
    }

    public function index(): View
    {
        return view('livewire.task.base-task');
    }

    
}
