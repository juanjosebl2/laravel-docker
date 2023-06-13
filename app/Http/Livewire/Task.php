<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Task as TaskModel;

class Task extends Component
{

    public $tasks;
    public TaskModel $task;

    public function rules()
    {
        return [
            'task.text' => 'required|max:10',
        ];
    }

    //run once
    public function mount()
    {
        $this->tasks = TaskModel::orderBy('id','desc')->get();
        $this->task = new TaskModel();
    }

    //check automatic task.text -> ipdated"TaskText"
    public function updatedTaskText()
    {
        $this->validate(['task.text' => 'max:10']);
    }

    public function edit(TaskModel $task)
    {
        $this->task = $task;
    }

    //For search save in BD
    public function save()
    {
        $this->validate();
        $this->task->save(); //Save in database
        $this->mount(); //For clear search after the press save
        $this->emitUp('taskMessage', 'Task saved successfully');
    }

    public function delete($id)
    {
        $taskToDelete = TaskModel::find($id);

        if(!is_null($taskToDelete)) {
            $taskToDelete->delete();
            $this->emitUp('taskMessage', 'Task deleted succesfully');
            $this->mount();
        }
    }

    public function done(TaskModel $task)
    {
        $task->update(['done' => !$task->done]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.task.task');
    }

    public function index(): View
    {
        return view('livewire.task.task');
    }
}
