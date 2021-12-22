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
            dd($th->getMessage());
            return  back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
    }

    public function update()
    {

        try {
            $request = $this->request();

            $planification = $this->model('planification')->findOrFail($request->parent_id);

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
        $form = ModuleController::form($planification, $managemet, 'admin.modules.fibra-optica.store', 'admin.modules.fibra-optica.update');

        return $this->loadView('Admin.Modules.AnswerTask', $form);
    }
}
