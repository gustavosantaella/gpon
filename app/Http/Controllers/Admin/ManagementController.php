<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\{
    Management,
    Task
};


class ManagementController extends BaseController
{
    public function index(): \Inertia\Response
    {
        $managements = $this->model('management')->where('name', 'like', "%{$this->request()->text}%")->paginate(3);

        return $this->loadView('Admin.Managements.index', compact('managements'));
    }

    public function edit(Management $gerencia): \Inertia\Response
    {
        $tasks = $gerencia->tasks()->orderBy('id','DESC')->paginate(5, ['*'], 'tasks_page');
        $users = $gerencia->users()->orderBy('id','DESC')->paginate(5, ['*'], 'users_page');

        return $this->loadView('Admin.Managements.edit', compact('gerencia','tasks', 'users'));
    }

    public function storeTask(Management $gerencia)
    {
        $this->request()->validate([
            'title'=>['required' ,'unique:tasks'],
            'description'=>['required','Min:5'],
            'end_days'=>'required'
        ]);

        $data = $this->request()->only(['title', 'description', 'end_days']);
        if($gerencia)
            $gerencia->tasks()->create($data);

        return back();
    }

    public function updateTask(Management $gerencia, Task $task)
    {
        $this->request()->validate([
            'title'=>['required' ,"unique:tasks,title,{$this->request()->id}"],
            'description'=>['required','Min:5'],
            'end_days'=>'required'
        ]);

        $data = $this->request()->only(['title', 'description', 'end_days']);
        if($gerencia)
            $gerencia->tasks()->find($task->id)->update($data);

        return back();
    }

    public function deleteTask(Management $gerencia, Task $task)
    {

    }
}
