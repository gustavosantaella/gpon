<?php

namespace App\Traits;


trait UpdateOrCreateOnNull
{
    /**
     * @param $id
     * @param array $values
     * @return static
     */
    public static function updateOrCreateOnNull($id, array $values = [])
    {
        if (is_null($id)) {
            $model = new self();
        } else {
            $model = self::find($id);
        }
        $model->fill($values);
        $model->save();
        return $model;
    }
}
