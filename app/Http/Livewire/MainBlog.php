<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;

class MainBlog extends Component
{
    public function render()
    {
        return view('livewire.main-blog');
    }

    public function index(): View
    {
        return view('livewire.main-blog');
    }
}
