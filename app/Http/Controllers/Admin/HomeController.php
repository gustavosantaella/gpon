<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Inertia\Inertia;

class HomeController extends BaseController
{
    public function index()
    {
	    $managements =  $this->model('management')->all();
		Inertia::share('managements', $managements);	    
	    return $this->loadView('Admin.Dashboard');
    }
}
