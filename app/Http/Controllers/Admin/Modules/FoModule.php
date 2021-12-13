<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Models\Planification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\AnswerLine;
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
            ->join('parishes', 'parishes.id', 'planifications.parish_id')
            ->join('municipalities', 'municipalities.id', 'parishes.municipality_id')
            ->join('states', 'states.id', 'municipalities.state_id')
            ->orderBy('id', 'desc')

            ->paginate(5);

        return $this->loadView('Admin.Modules.FibraOptica.index', compact('planifications'));
    }

    public function store()
    {
        try {

            $request = $this->request();
          
            $request->validate([
                'data' => ['required', 'array'],
            ]);

            foreach ($request->data as $data) {
                if (!array_key_exists('task_id', $data) || !array_key_exists('answer', $data)) {
                    return back()->with('warning', 'Por favor revise que todos los campos esten completos');
                }
            }

            $planification = $this->model('planification')->find($request->parent_id);
            $answer =   $planification->answers()->create([
                'management_id' => $request->management_id,
                'observation' => 'this is my observation'
            ]);

            foreach ($request->data as $data) 
            {
                $value = $data['answer'];
                if (File::exists($value)) {
                    $file = $data['answer'];
                    $value = $file->store('files', 'public');
                }
                $answer->lines()->create([
                    'task_id' => $data['task_id'],
                    'answer' => $value
                ]);
            }

            return redirect()->route('admin.modules.fibra-optica.index')->with('status', 200);
        } catch (\Throwable $th) {
            return back()->with("error","Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
            
        }
    }

    public function update(Planification $fibra_optica)
    {
          /**
           * try {
           */

            $request = $this->request();
     dd($request->data);
            $request->validate([
                'data' => ['required', 'array'],
            ]);
      
             $planification = $fibra_optica;
             $managemet = $this->model('management')->findByName('fibra optica');
            $answer =   $planification->answers()->get_management($managemet->id);
            

           foreach ($request->data as $data) 
            {
                $value = $data['answer'];
                if (File::exists($value)) {
                   
                    $file = $data['answer'];
                    $value = $file->store('files', 'public');
                }
                AnswerLine::UpdateOrCreateOnNull($data['line_id'] ?? null,[ 
                    'answer' => $value
                ]);
            }

                  dd($request->data);
        /**
         * 
         * } catch (\Throwable $th) {
            
            return back()->with("error","Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
            
        }**/
    }


    public function edit(Planification $fibra_optica)
    {
        $planification = $fibra_optica;
        $managemet = $this->model('management')->findByName('fibra optica');
        $tasks = $managemet->tasks;

        $answer = $planification->answers()->get_management($managemet->id)->first();

        $lines = null;
        if ($answer) {
            $lines = $answer->lines()->with('task')->get();
        }


        $routeUrl = [
            'store' => [
                'url' => "admin.modules.fibra-optica.store",
                'params' => [
                    'management_id' => $managemet->id,
                    'parent_id' => $fibra_optica->id
                ]
            ],

            'update' => [
                'url' => "admin.modules.fibra-optica.update",
                'params' => [
                    'management_id' => $managemet->id,
                    'fibra_optica' => $fibra_optica->id
                ]
            ],
        ];
        return $this->loadView('Admin.Modules.FibraOptica.edit', compact('tasks', 'lines', 'answer', 'routeUrl'));
    }
}
