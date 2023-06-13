<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class Blog extends Component
{
    public function render()
    {
        return view('livewire.blog');
    }

    public function index(): View
    {
        return view('livewire.blog');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
 
        $request->user()->blogs()->create($validated);
 
        return redirect(route('blogs.index'));
    }
}
