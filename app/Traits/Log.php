<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log as LaravelLog;

trait Log
{
    /**
     * @param string $driver
     * @param string $path
     * @return mixed
     */
    public function log(string $driver = 'single',string $path = 'logs/custom.log')
    {
     $log =  new LaravelLog();

        return $log::build([
            'driver'=>$driver,
            'path' => storage_path($path),
        ]);
    }
}
