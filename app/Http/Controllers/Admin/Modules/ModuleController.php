<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Models\AnswerLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\BaseController;
use App\Models\Management;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class ModuleController extends BaseController
{

    public static function form(Model $parent_model, Management $management, string $routeStore, string $routeUpdate)
    {

        $tasks = $management->tasks;

        $answer = $parent_model->answers()->get_management($management->id)->first();

        $lines = null;
        if ($answer) {
            $lines = $answer->lines()->with('task')->get();
        }


        $routeUrl = [
            'store' => [
                'url' => $routeStore,
                'params' => [
                    'management_id' => $management->id,
                    'parent_id' => $parent_model->id
                ]
            ],

            'update' => [
                'url' => $routeUpdate,
                'params' => [
                    'management_id' => $management->id,
                    'parent_id' => $parent_model->id
                ]
            ],
        ];
        return compact('tasks', 'lines', 'answer', 'routeUrl');
    }

    public static function show()
    {
    }

    /**
     * Undocumented function
     *
     * @param Model $parent_model
     * @return mixed
     */
    public function store(Model $parent_model)
    {

        $request = $this->request();

        $request->validate([
            'data' => ['required', 'array'],
        ]);

        foreach ($request->data as $data) {
            if (!array_key_exists('task_id', $data) || !array_key_exists('answer', $data)) {
                return back()->with('warning', 'Por favor revise que todos los campos esten completos');
            }
        }

        $management = $this->model('management')->find($request->management_id);
          $answer =   $parent_model->answers()->create([
            'management_id' => $request->management_id,
            'observation' => 'this is my observation',
            ]);
            if($management->construction){
            return $this->test($parent_model, $answer, $management);
        }
    
        foreach ($request->data as $data) {

            $value = $data['answer'];
            if (File::exists($value)) {
                $file = $data['answer'];
                $value = $file->store('files', 'public');
            }
            $this->create($answer, $value, $data['task_id']);
        }

        return true;
    }

    public function create($answer, $value, $task_id)
    {
        $answer->lines()->create([
            'task_id' => $task_id,
            'answer' => $value
        ]);
    }

    public function update(Model $parent_model, Model $answer)
    {
        $request = $this->request();
        $request->validate([
            'data' => ['required', 'array'],
        ]);
        $management = $this->model('management')->find($request->management_id);
        if($management->construction){
            return $this->test($parent_model, $answer, $management);
        }
        $calc = (count($request->data) * 100) / $management->tasks()->count();
        $porcent = round($calc, 0);
        $answer->porcent = $porcent;
        foreach ($request->data as $data) {
            $value = $data['answer'];
            if (File::exists($value)) {

                $file = $data['answer'];
                $value = $file->store('files', 'public');
            }
            if (isset($data['line_id'])) {
                $lines = $answer->lines()->find($data['line_id'])->update([
                    'answer' => $value,
                ]);
            }else $this->create($answer, $value, $data['task_id']);
        }
        $answer->save();
        return true;
    }

    public function test(Model $parent_model, Model $answer, $management)
    {
         $request = $this->request();
           $request->validate([
            'data.*.answer' => ['numeric', 'required'],
        ]);
         
        $taskCount = $management->tasks()->count();
        
        
        $notPorcents = []; 
        $porcent = 0; 
        $condition = false;
         foreach ($request->data as $data) {
            $value = $data['answer'];
        if($value > 100) {
            $notPorcents[] = $value;
            $value = 0;
        }else $porcent += $value;

            if (isset($data['line_id'])) {
                
                $lines = $answer->lines()->find($data['line_id'])->update([
                    'answer' => $value,
                ]);
            } else $this->create($answer, $value, $data['task_id']);
        }

 
        
        if(count($notPorcents) > 0) 
        {
              Session::flash('menssage', 'Los porcentajes(%) no pueden ser mayor a 100(%)');
            $return =   redirect()->route("admin.modules.construcciones.index");
           
        } else{
             Session::flash('status', 200);
            $return =   redirect()->route("admin.modules.construcciones.index");
        }

       $totalPorcent =  floor($porcent / $taskCount);
        if(!$answer->porcent){
            if($totalPorcent < $answer->porcent){
                $return =redirect()->route("admin.modules.construcciones.index")->with('error', 'La sumatoria de porcentajes no puede ser menor al porcentaje de la construccion');

            }else $answer->porcent =  ($totalPorcent); 
        }else{
            if($totalPorcent < $answer->porcent){
                $return =redirect()->route("admin.modules.construcciones.index")->with('error', 'La sumatoria de porcentajes no puede ser menor al porcentaje de la construccion');
            }
                else $answer->porcent =  ($totalPorcent); 

        } 

        $answer->save();
       
       // dd($porcent);
         
        return $return;
    }
}
