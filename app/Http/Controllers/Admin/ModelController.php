<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class ModelController extends BaseController
{
    public function index()
    {
 
        $models = $this->model('model')
        ->select([
            'providers.name as provName',
            'models.*',
        ])
        ->join('providers', 'models.provider_id', '=', 'providers.id')->paginate(5);
        dd($models);

        return $this->loadView('Admin.Models.index', compact(
            'models'
        ));
    }
}
