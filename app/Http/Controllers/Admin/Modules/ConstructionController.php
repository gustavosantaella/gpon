<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Construction;

class ConstructionController extends BaseController
{
    public function index()
    {
        $query = Construction::query();
          $query->select([
            'constructions.*',
            'planifications.name',
            'planificcations.status'
            'parishes.id as parishId',
            'parishes.name as parishName',
            'municipalities.id as munId',
            'municipalities.name as munName',
            'states.id as stateid',
            'states.name as stateName'
        ]);
            $query->join('planifications', 'planification_id', 'planifications.id');
              $query->join('parishes', 'parishes.id', 'planifications.parish_id')
        ->join('municipalities', 'municipalities.id', 'parishes.municipality_id')
        ->join('states', 'states.id', 'municipalities.state_id');

        $query->with('managements.tasks.lines');

        $construction = $query->paginate(5);
        

       return  $this->loadView('Admin.Modules.Construction.index',compact('construction'));
    }

    public function show(Construction $construction){}

    public function update(Construction $construction){}

    public function edit(Construction $construction){}

    public function destroy(Construction $construction){}
}
