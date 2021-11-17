<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class ManagementController extends BaseController
{
    public function index()
    {
        $managements = $this->model('management')->paginate(5);

        return $this->loadView('Admin.Managements.index', compact('managements'));
    }
}
