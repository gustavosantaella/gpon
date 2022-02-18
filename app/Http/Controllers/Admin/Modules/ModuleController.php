<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Models\AnswerLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\BaseController;
use App\Models\Management;
use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class ModuleController extends BaseController
{

    public static function form(Model $parent_model, Management $management, string $routeStore, string $routeUpdate)
    {

        $tasks = $management->tasks()->orderBy('id', 'desc')->get();

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
        return compact('tasks', 'lines', 'answer', 'routeUrl', 'management');
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
            'data.*' => ['required'],


        ]);

        $management = $this->model('management')->find($request->management_id);
        if ($management->construction) {
            $request->validate([
                'data.*.observation' => ['required']

            ]);
        }

        foreach ($request->data as $data) {
            if ($management->construction) {
                if (!File::exists($data['answer']) && is_numeric($data['answer'])) {
                    if ($data['answer'] > 100) {

                        Session::flash('menssage', 'Los porcentajes(%) no pueden ser mayor a 100(%)');
                        return back();
                    }
                }
            }
        }


        $answer =  $parent_model->answers()->create([
            'management_id' => $request->management_id,
            'observation' => 'this is my observation',
        ]);

        if ($management->construction) {
            return $this->test($parent_model, $answer, $management);
        }

        foreach ($request->data as $data) {

            $value = $data['answer'];
            if (File::exists($value)) {
                $file = $data['answer'];
                $value = $file->store('files', 'public');
            }
            $this->create($answer, $value, $data);
        }

        return true;
    }

    public function create($answer, $value, $data)
    {
        $task = Task::find($data['task_id']);
        $answer->lines()->create([
            'task_id' => $task->id,
            'answer' => $value,
            'observation' => $data['observation'] ?? null
        ]);
    }

    public function update(Model $parent_model, Model $answer)
    {
        $request = $this->request();
        $request->validate([
            'data' => ['required', 'array'],
        ]);
        $management = $this->model('management')->find($request->management_id);
        if ($management->construction) {
            $request->validate([
                'data.*.observation' => ['required']

            ]);
        }
        if ($management->construction) {
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
            } else $this->create($answer, $value, $data);
        }
        $answer->save();
        return true;
    }

    public function test(Model $parent_model, Model $answer, $management)
    {
        $request = $this->request();
        $request->validate([
            'data.*.answer' => ['required'],
            'data.*.task_id' => ['required'],
            'data.*.observation' => ['required'],
        ]);

        $taskCount = $management->tasks()->count();


        $notPorcents = [];
        $porcent = 0;
        foreach ($request->data as $data) {

            $task = Task::find($data['task_id']);
            $value = $data['answer'];

            if (File::exists($value)) {
                $file = $data['answer'];
                $value = $file->store('files', 'public');
                $porcent += 100;
            } else {
                if ($value > 100) {
                    $notPorcents[] = $value;
                    $value = 0;
                } else $porcent += $value / $task->porcent;
            }


            if (isset($data['line_id'])) {

               $lines = $answer->lines()->find($data['line_id']);
              // $answer_porcent = ($value / $lines->task->porcent);
               if($value >= $lines->answer){
                   $lines->update([
                    'answer' => $value,
                    'observation' => $data['observation'] ?? null
                ]);
               }
            } else $this->create($answer, $value, $data);
        }



        if (count($notPorcents) > 0) {
            Session::flash('menssage', 'Los porcentajes(%) no pueden ser mayor a 100(%)');

            $return =   back();
        } else {
            Session::flash('status', 200);
            $return =   redirect()->route('admin.modules.construcciones.index');
        }

        $totalPorcent =  floor($porcent / $management->porcent);


        if ($totalPorcent < $answer->porcent) {
            $return = back()->with('error', 'La sumatoria de porcentajes no puede ser menor al porcentaje de la construccion');
        } else {

            $answer->porcent =  ($totalPorcent);
            $answer->save();
        }




        // dd($porcent);

        return $return;
    }
}
