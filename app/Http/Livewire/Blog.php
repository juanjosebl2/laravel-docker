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
            'blog.title' => 'required|max:100',
            'blog.description' => 'required|max:200',
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
        $user = auth()->user();
        $this->blog->user_id = $user->id;
        $this->blog->save(); //Save in database
        $this->mount(); //For clear search after the press save
    }

    public function edit(BlogModel $blog)
    {
        $this->blog = $blog;
    }

    public function delete($id)
    {
        $blogToDelete = BlogModel::find($id);

        if(!is_null($blogToDelete)) {
            $blogToDelete->delete();
            $this->mount();
        }
    }

    public function render()
    {
        return view('livewire.blog');
    }

    public function index(): View
    {
        return view('livewire.blog');
    }

}
