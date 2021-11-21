<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{
    public function index()
    {
        $this->loadView('Admin.users.index');
    }
}
