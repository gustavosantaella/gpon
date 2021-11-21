<?php

namespace App\Http\Controllers;

use App\Interfaces\BaseInterface;
use App\Traits\Log;
use App\Traits\Request;


class BaseController extends Controller implements BaseInterface
{
    use Request, Log;
}
