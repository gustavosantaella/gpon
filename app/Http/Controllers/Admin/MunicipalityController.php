<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\State;

class MunicipalityController extends BaseController
{
     public function getMunicipalities(State $state)
    {
        $municipalities = $state->municipalities()->get(['id','name']);
        return response()->json($municipalities);
    }
}
