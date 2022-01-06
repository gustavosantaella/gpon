<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{
    public function index()
    {
        $users = $this->model('user')->all()->except(auth()->id());
      return  $this->loadView('Admin.User.index',compact('users'));
    }
}
