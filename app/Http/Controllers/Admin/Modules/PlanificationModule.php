<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class PlanificationModule extends BaseController
{
	public function index()
	{

	 return $this->loadView('Admin.Modules.Planifications.index');
	}
}
