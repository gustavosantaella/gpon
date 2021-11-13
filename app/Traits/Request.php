<?php

namespace App\Traits;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

trait Request
{
    /**
     * @return array|Application|\Illuminate\Http\Request|string
     */
    public function request()
    {
        return request();
    }

    /**
     * @param string $view
     * @param array $params
     *
     * @return Response
     */
    public function loadView(string $view, array $params = []): Response
    {
        $string = self::standar($view);
        $view = str_replace('.', '/', $string);
        return Inertia::render($view,$params);
    }

    /**
     * @param string $model
     * @return Model
     */
    public function model(string $model): Model
    {
        $ucfirst = self::standar($model);
        $split = str_split($ucfirst);
        if (end($split) === 's') array_pop($split);

        $model = implode('', $split);
        return app("App\\Models\\$model");
    }

    public static function standar(string $string) : string
    {
        $upper = Str::upper($string);
        $lower = Str::lower($upper);
        return Str::ucfirst($lower);
    }
}
