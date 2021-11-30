<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class ModelController extends BaseController
{
    public function index()
    {
 
        $models = $this->model('model')->paginate(5);
        return $this->loadView('Admin.Models.index', compact(
            'models'
        ));
    }
}
