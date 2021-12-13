<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Models\Planification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FoModule extends BaseController
{
    public function index()
    {
       $planifications = $this->model('planification')->select([
            'planifications.*',
            'parishes.id as parishId',
            'parishes.name as parishName',
            'municipalities.id as munId',
            'municipalities.name as munName',
            'states.id as stateid',
            'states.name as stateName'
        ])
                         ->join('parishes','parishes.id','planifications.parish_id')
                         ->join('municipalities','municipalities.id','parishes.municipality_id')
                         ->join('states','states.id','municipalities.state_id')
                         ->orderBy('id','desc')

        ->paginate(5);

        return $this->loadView('Admin.Modules.FibraOptica.index', compact('planifications'));
    }

    public function store()
    {
        $request = $this->request();
        $request->validate([
            'data'=>['required','array']
        ]);
        foreach($request->data as $data){
            if(!array_key_exists('task_id', $data) && !array_key_exists('answer', $data)){
                return back()->with('warning','Por favor revise que todos los campos esten completos');
            }

        }

        $managemet = $this->model('management')->find($request->parent_id);

        $answer = $managemet->answer()->create([
            'management_id'=>$request->management_id,
            'observation'=>'this is my observation'
        ]);

        foreach($request->data as $data){
            $value = $data['answer'];
            if(File::exists($value))
            {
                $file = $data['answer'];
                $value = $file->store('files','public');

            }
             $answer->lines()->create([
                 'task_id'=> $data['task_id'],
                 'answer'=>$value
             ]);
        }

        return redirect()->route('admin.modules.fibra-optica.index')->with('status', 200);


    }



    public function edit(Planification $fibra_optica)
    {
          $managemet = $this->model('management')->findByName('fibra optica');
          $tasks = $managemet->tasks;

          $route = route('admin.modules.fibra-optica.store',[
              'parent_id'=>$fibra_optica->id,
              'management_id'=>$managemet->id
          ]);
          return $this->loadView('Admin.Modules.FibraOptica.edit', compact('tasks','route'));
    }



}
