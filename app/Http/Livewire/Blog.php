<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Blog as BlogModel;

class Blog extends Component
{

    public $blogs;
    public BlogModel $blog;

    public function rules()
    {
        return [
            'blog.title' => 'required|max:10',
        ];
    }

    //run once
    public function mount()
    {
        $this->blogs = BlogModel::orderBy('id','desc')->get();
        $this->blog = new BlogModel();
    }

    //For search save in BD
    public function save()
    {
        $this->validate();
        $this->blog->save(); //Save in database
        $this->mount(); //For clear search after the press save
    }

    public function render()
    {
        return view('livewire.base-blog');
    }

    public function index(): View
    {
        return view('livewire.base-blog');
    }

}
