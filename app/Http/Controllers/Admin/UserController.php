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
      $users = $this->model('user')->all()->except(auth()->id());
      return  $this->loadView('Admin.User.index',compact('users'));
    }

    public function create()
    {
        $managements = $this->model('management')->all();
         return $this->loadView('Admin.User.create', compact('managements'));
    }

    public function store(Request $request)
    {try {

            $s = $this->request()->validate([
                'name' => ['required', 'string'],
                'email' => ['unique:users,email']
            ]);


            $management = $request->management_id;

            $user = $this->model('user')->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password')
            ]);

            $man =  $user->management()->attach($management);
            return back()->with('status', 200);
    } catch (\Throwable $th) {
        return back()->with('error', $th->getMessage());
    }

    }
}
