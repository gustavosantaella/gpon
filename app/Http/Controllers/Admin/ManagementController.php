<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class ManagementController extends BaseController
{
    public function index()
    {
        return $this->loadView('Admin.Management.index');
    }
}
