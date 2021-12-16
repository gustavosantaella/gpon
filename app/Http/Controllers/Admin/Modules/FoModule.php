<?php

namespace App\Http\Controllers\Admin\Modules;


use App\Models\AnswerLine;
use App\Models\Planification;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Modules\ModuleController;

class FoModule extends BaseController
{
    public function index()
    {
        $planifications = PlanificationModule::list();

        return $this->loadView('Admin.Modules.FibraOptica.index', compact('planifications'));
    }

    public function store()
    {
        try {
            $request = $this->request();
            $planification = $this->model('planification')->find($request->parent_id);

            $module = new ModuleController();

            if ($module->store($planification) === true) {
                return redirect()->route('admin.modules.fibra-optica.index')->with('status', 200);
            } else return  back()->with("error", "Por favor comuniquese con soporte...");
        } catch (\Throwable $th) {
            dd(12);
            return  back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
    }

    public function update()
    {
        try {
            $request = $this->request();
            $planification = $this->model('planification')->findOrFail($request->fibra_optica);
            $answer = $planification->answers()->findOrfail($request->answer_id);
            $module = new ModuleController();

            if ($module->update($planification, $answer) === true) {

                return redirect()->route('admin.modules.fibra-optica.index')->with('status', 200);

            } else return  back()->with("error", "Por favor comuniquese con soporte...");

        } catch (\Throwable $th) {

            return back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
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
