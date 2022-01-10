<?php

namespace App\Traits;


trait RolesAndPermissions
{
    public function hasRoles($model)
    {
        $roles = $this->model('role')->all();
        $haverRole =  $model->roles()->get();
        $array_roles = array();
        foreach ($roles as $key => $role) {

            if ($haverRole->contains($role)) {
                $array_roles[$key]['check']= true ;
            }else{
                $array_roles[$key]['check']= false ;
            }
            $array_roles[$key]['id']= $role->id ;
            $array_roles[$key]['name']= $role->name ;

        }

        return $array_roles;

    }

       public function addOrRemoveRole()
    {
        $roles = $this->request()->selected;
        $model = $this->model(strtolower($this->request()->type))->find($this->request()->id);
       $model->syncRoles($roles);
        return response()->json($model->roles);
    }
}
