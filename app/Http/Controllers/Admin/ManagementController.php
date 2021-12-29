<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Traits\RolesAndPermissions;
use App\Models\{
    Management,
    Task,
    User
};
use Throwable;


class ManagementController extends BaseController
{
    use RolesAndPermissions;

    public function index(): \Inertia\Response
    {
        $prevOrNextPageName = 'page';
        $managements = $this->model('management')->where('name', 'like', "%{$this->request()->text}%")->paginate(3);
        return $this->loadView('Admin.Managements.index', compact('managements'));
    }

    public function store()
    {
        $data = $this->request()->validate([
            'name' => ['required', "unique:managements"],
            'position' => ['required', "unique:managements"],
            'acronym' => ['required', "unique:managements"],

        ]);

        $management = $this->model('management')->create($data);
        return redirect()->route('admin.gerencias.edit', $management)->with('status',200);
    }

    public function edit(Management $gerencia): \Inertia\Response
    {
        $taskType = [
            'number'=>'Numerico',
            'text'=>'Texto plano',
            'file'=>'Subir archivo',
            'textarea'=>'Texto largo',
            'date'=>'Ingresar una fecha',
        ];
        $tasks = $gerencia->tasks()->orderBy('id', 'DESC')->paginate(5, ['*'], 'tasks_page');
        $users = $gerencia->users()->orderBy('id', 'DESC')->paginate(5, ['*'], 'users_page');
        $roles = $this->hasRoles($gerencia);
        return $this->loadView('Admin.Managements.edit', compact('gerencia', 'tasks', 'users', 'roles', 'taskType'));
    }

    public function update(Management $gerencia)
    {
        $data = $this->request()->validate([
            'name' => ['required', "unique:managements,name,{$this->request()->id}"],
            'position' => ['required', "unique:managements,position,{$this->request()->id}"],

        ]);
        try {
            $gerencia->update($data);
            return back()->with('status', 200);
        } catch (Throwable  $e) {
            return $e->getMessage();
        }
    }

    public function storeTask(Management $gerencia)
    {

        $this->request()->validate([
            'title' => ['required', 'unique:tasks'],
            'description' => ['required', 'Min:5'],
            'end_days' => 'required',
            'field_type' => 'required'
        ]);


        $data = $this->request()->only(['title', 'description', 'end_days', 'field_type']);
        if ($gerencia)
            $gerencia->tasks()->create($data);

        return back()->with('status', 200);
    }

    public function updateTask(Management $gerencia, Task $task)
    {

        $this->request()->validate([
            'title' => ['required', "unique:tasks,title,{$this->request()->id}"],
            'description' => ['required', 'Min:5'],
            'end_days' => 'required',
            'field_type' => 'required'
        ]);

        $data = $this->request()->only(['title', 'description', 'end_days', 'field_type']);
        if ($gerencia)
            $gerencia->tasks()->find($task->id)->update($data);

        return back()->with('status', 200);
    }

    /**
     * Comment s
     *
     * @param  Management $gerencia
     * @param Task $task
     * @return void
     */
    public function deleteTask(Management $gerencia, Task $task)
    {

            $gerencia->tasks()->find($task->id)->delete();
            return back();
    }

    public function getUsers()
    {
        $users = $this->model('user')->all();
        return response()->json($users);
    }

    public function addUserToManagement(Management $gerencia)
    {

        $this->request()->validate([
            'user_id' => ['required', "unique:user_has_managements"],
        ]);

        $user_id = $this->request()->user_id;
        $gerencia->users()->attach($user_id);
        return back()->with('status', 200);
    }

    public function removeUser(Management $gerencia, User $user)
    {
        $gerencia->users()->detach($user);
        return back()->with('status', 200);
    }

    public function addOrRemoveRole(Management $gerencia)
    {
        $roles = $this->request()->selected;

        if ($roles) $gerencia->roles()->sync($roles);
        return response()->json($gerencia->roles);
    }

    public function destroy(Management $gerencia)
    {
        $gerencia->delete();
        return back();
    }
}
