<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Traits\RolesAndPermissions;

class UserController extends BaseController
{
    use RolesAndPermissions;

    public function __construct(){
        $this->middleware('can:CREAR USUARIOS', ['only' => ['create', 'store']]);
        $this->middleware('can:EDITAR USUARIOS', ['only' => ['edit', 'update']]);
        $this->middleware('can:ELIMINAR USUARIOS', ['only' => ['delete']]);
        $this->middleware('can:LISTAR USUARIOS', ['only' => ['index']]);
    }

    public function index()
    {

        $users = $this->model('user')->all();
        return  $this->loadView('Admin.User.index', compact('users'));
    }

    public function create()
    {
        $user = (new User)->toArray();
        $managements = $this->model('management')->all();
         $user += ['roles'=>$this->hasRoles(new User)];
        return $this->loadView('Admin.User.create', compact('managements', 'user'));
    }

    public function store(Request $request)
    {
        try {

            $s = $this->request()->validate([
                'name' => ['required', 'string'],
                'email' => ['unique:users,email', 'required'],
                  'dni' => ['unique:users,dni', 'required'],
                  'management_id'=>['required','numeric'],
                    'role'=>['array', 'required'],
                  'role.*'=>['required']
            ]);

            $management = $request->management_id;

            $user = $this->model('user')->create([
                'name' => $request->name,
                'email' => $request->email,
                'dni'=>$request->dni,
                'password' => Hash::make('password')
            ]);

            $roles = $this->request()->role;
            $user->roles()->attach($roles);
            $man =  $user->management()->attach($management, [
                'responsable'=>$request->responsable
            ]);
            return back()->with('status', 200);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function  edit(User $usuario)
    {

         $user = $usuario->toArray();
        $user += ['permissions'=>$usuario->getAllPermissions()];
        $user += ['management' => $usuario->management];

        $managements = $this->model('management')->all();
        $user += ['roles'=>$this->hasRoles($usuario)];

          return $this->loadView('Admin.User.Edit', compact('managements', 'user'));
    }

    public function update(Request $request, User $usuario)
    {

        $this->request()->validate([
                'name' => ['required', 'string'],
                'email' => ["unique:users,email,{$usuario->id},id", 'required'],
                'dni' => ["unique:users,dni,$usuario->id", 'required'],
                      'management_id'=>['required','numeric']
            ]);

            $management = $request->management_id;
            $user = $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'dni'=>$request->dni,

            ]);
              $roles = $this->request()->role;

              $usuario->syncRoles($roles);


            $man =  $usuario->management()->syncWithPivotValues($management, [
                'responsable'=>$request->responsable
            ]);
            return back()->with('status', 200);

    }


}
