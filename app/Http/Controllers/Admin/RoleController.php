<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class RoleController extends BaseController
{
    public function index()
    {
        $roles = $this->model('roles')->with('permissions')->get();

        return $this->loadView('Admin.roles.index', compact('roles'));
    }
}
