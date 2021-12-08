<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Municipality;
class ParishController extends BaseController
{
      public function getParishes(Municipality $municipality)
    {
        $parishes = $municipality->parishes()->get(['id','name']);
        return response()->json($parishes);
    }

}
