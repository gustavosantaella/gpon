<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\PlanificationFiles;

class FileController extends BaseController
{
    public function destroy(PlanificationFiles $fileId)
    {
        $fileId->delete();
        return back()->with('status', 200);
    }
}
