<?php

namespace App\Interfaces;

interface BaseInterface
{
    /**
     * @return mixed
     */
    public function request();

    /**
     * @param string $view
     * @param array $params
     * @return mixed
     */
    public function loadView(string $view , array $params = []);

    /**
     * @param string $model
     * @return mixed
     */
    public function model(string $model);
}
