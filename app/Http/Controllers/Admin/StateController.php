<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class StateController extends BaseController
{
    public function getStates()
    {
        $states = $this->model('state')->get(['id','name']);
        return response()->json($states);
    }
}
