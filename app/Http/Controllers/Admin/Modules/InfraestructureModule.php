<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Planification;

class InfraestructureModule extends BaseController
{
    public function index()
    {
        $planifications = PlanificationModule::list();

        return $this->loadView('Admin.Modules.Infraestructure.index', compact('planifications'));
    }


    public function store()
    {
        try {
            $request = $this->request();
            $planification = $this->model('planification')->find($request->parent_id);
            $module = new ModuleController();

            if ($module->store($planification) === true) {

                return redirect()->route('admin.modules.infraestructura.index')->with('status', 200);
            } else return  back()->with("error", "Por favor comuniquese con soporte...");
        } catch (\Throwable $th) {
        
            return  back()->with("error", "Por favor comuniquese con soporte... Mensaje {$th->getMessage()}");
        }
    }

     public function edit(Planification $infraestructura)
    {

        $planification = $infraestructura;
        $managemet = $this->model('management')->findByName('infraestructura');
        $form = ModuleController::form($planification, $managemet, 'admin.modules.infraestructura.store', 'admin.modules.infraestructura.update');
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
                return redirect()->route('admin.modules.infraestructura.index')->with('status', 200);

            } else return  back()->with("error", "Por favor comuniquese con soporte...");

        } catch (\Throwable $th) {

            return back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
    }
}
