<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;

class MainBlog extends Component
{
    public $welcome = 'BLOGS CRUD';

    public function render()
    {
        return view('livewire.blog.main-blog');
    }

    public function index(): View
    {
        return view('livewire.blog.main-blog', ['welcome' => $this->welcome]);
    }
}
