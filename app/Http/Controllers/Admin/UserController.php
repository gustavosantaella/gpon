<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        $users = $this->model('user')->all();
        return  $this->loadView('Admin.User.index', compact('users'));
    }

    public function create()
    {
        $managements = $this->model('management')->all();
        return $this->loadView('Admin.User.create', compact('managements'));
    }

    public function store(Request $request)
    {
        try {

            $s = $this->request()->validate([
                'name' => ['required', 'string'],
                'email' => ['unique:users,email', 'required'],
                  'dni' => ['unique:users,dni', 'required'],
            ]);


            $management = $request->management_id;

            $user = $this->model('user')->create([
                'name' => $request->name,
                'email' => $request->email,
                'dni'=>$request->dni,
                'password' => Hash::make('password')
            ]);

            $man =  $user->management()->attach($management);
            return back()->with('status', 200);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function  edit(User $usuario)
    {
     
         $user = $usuario->load(['roles'])->toArray();
        $user += ['permissions'=>$usuario->getAllPermissions()];
        $user += ['management'=>$usuario->management];
        $managements = $this->model('management')->all();
       
          return $this->loadView('Admin.User.Edit', compact('managements', 'user'));
    }

    public function update(Request $request, User $usuario)
    {

        $this->request()->validate([
                'name' => ['required', 'string'],
                'email' => ["unique:users,email,{$usuario->id},id", 'required'],
                'dni' => ["unique:users,dni,$usuario->id", 'required'],
            ]);

            $management = $request->management_id;
            $user = $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'dni'=>$request->dni,
             
            ]);

            $man =  $usuario->management()->sync($management);
            return back()->with('status', 200);

    }
}
