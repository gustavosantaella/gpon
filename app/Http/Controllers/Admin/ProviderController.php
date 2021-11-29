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

    public function destroy(Provider $proveedore)
    {
        $proveedore->delete();
        return back();
    }
}
