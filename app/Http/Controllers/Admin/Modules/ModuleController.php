<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Models\AnswerLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\BaseController;
use App\Models\Management;
use Inertia\Inertia;

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


        $answer =   $parent_model->answers()->create([
            'management_id' => $request->management_id,
            'observation' => 'this is my observation'
        ]);

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
            } else $this->create($answer, $value, $data['task_id']);


        }

        return true;
    }
}
