<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Modules\PlanificationModule;

class RedLocalModule extends BaseController
{
    public function index()
    {
        $planifications = PlanificationModule::list();

        return $this->loadView('Admin.Modules.FibraOptica.index', compact('planifications'));
    }
}
