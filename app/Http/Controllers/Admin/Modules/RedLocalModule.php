<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Modules\PlanificationModule;
use App\Models\Planification;

class RedLocalModule extends BaseController
{
    public function index()
    {
        $planifications = PlanificationModule::list();

        return $this->loadView('Admin.Modules.RedLocal.index', compact('planifications'));
    }

        public function store()
    {
        try {
            $request = $this->request();
            $planification = $this->model('planification')->find($request->parent_id);
            $module = new ModuleController();

            if ($module->store($planification) === true) {

                return redirect()->route('admin.modules.energia.index')->with('status', 200);
            } else return  back()->with("error", "Por favor comuniquese con soporte...");
        } catch (\Throwable $th) {
         dd($th->getMessage());
            return  back()->with("error", "Por favor comuniquese con soporte... Mensaje}");
        }
    }


    public function edit(Planification $red_local)
    {

         $planification = $red_local;
        $managemet = $this->model('management')->findByName('red local');
        ;
        $form = ModuleController::form($planification, $managemet, 'admin.modules.red-local.store', 'admin.modules.red-local.update');
  

        return $this->loadView('Admin.Modules.AnswerTask', $form);
    }

    public function update()
    {
         try {
            $request = $this->request();
            $planification = $this->model('planification')->findOrFail($request->parent_id);
         
            $answer = $planification->answers()->findOrfail($request->answer_id);
            $module = new ModuleController();

            if ($module->update($planification, $answer) === true) {
                return redirect()->route('admin.modules.red-local.index')->with('status', 200);

            } else return  back()->with("error", "Por favor comuniquese con soporte...");

        } catch (\Throwable $th) {

            return back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
    }
}
