<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Model;

class ModelController extends BaseController
{
    public function index()
    {
 
        $models = $this->model('model')
                       ->select(['providers.name as prov', 'providers.id as provider_id','models.* as model'])
                        ->join('providers','providers.id','models.provider_id')
                        ->paginate(5);
       $providers = $this->model('provider')->all(); 
        return $this->loadView('Admin.Models.index', compact(
            'models',
            'providers'
        ));
    }

    public function store()
    {   
        $this->request()->validate([
            'name'=>['required'],
            'code'=>['required']
        ]);
        $model = $this->model('model');
        $model->create($this->request()->only([
            'name',
            'code',
            'provider_id'
        ]));

        return back()->with(['status'=>200]);
    }

    public function destroy(Model $modelo)
    {
        $modelo->delete();
        return back()->with(['status'=>200]);
    }
}
