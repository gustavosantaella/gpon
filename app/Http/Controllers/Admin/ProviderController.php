<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Provider;

class ProviderController extends BaseController
{
    public function index()
    {
        $providers = $this->model('provider')->paginate(5);

        return $this->loadView('Admin.Providers.index', compact('providers'));
    }

    public function store()
    {
        $data = $this->request()->validate([
            'name'=>['required', 'unique:providers']
        ]);

        $this->model('provider')->create($data);
        return back()->with('status', 200);
    }

    public function update(Provider $proveedore)
    {
         $data = $this->request()->validate([
            'name'=>['required', "unique:providers,name,{$proveedore->id}"]
        ]);

       $proveedore->update($data);
        return back()->with('status', 200);
    }

    public function destroy(Provider $proveedore)
    {
        $proveedore->delete();
        return back();
    }
}
