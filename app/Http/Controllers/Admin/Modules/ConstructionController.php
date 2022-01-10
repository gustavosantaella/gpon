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


        $query->with(['answers','managements.answers', 'planification.parish.municipality.state']);
        $construction = $query->get();
        $managements = $this->model('management')->whereConstruction(true)->with('answers')->get();


       return  $this->loadView('Admin.Modules.Construction.index',compact('construction', 'managements'));
    }

    public function store()
    {
        try {
            $request = $this->request();
            $construction = $this->model('construction')->find($request->parent_id);

            $module = new ModuleController();

            $moduleAction = $module->store($construction);

            if ($moduleAction === true) {
                return redirect()->route('admin.modules.construcciones.index')->with('status', 200);
            } else return $moduleAction;
        } catch (\Throwable $th) {
          
            return  back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
    }

    public function show(Construction $construction){}

    public function update()
    {
        try {
            $request = $this->request();

            $planification = $this->model('construction')->findOrFail($request->parent_id);

            $answer = $planification->answers()->findOrfail($request->answer_id);
            $module = new ModuleController();

           return $module->update($planification, $answer);
        } catch (\Throwable $th) {

            return back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
    }

    public function edit(Construction $construccione){

        $array = [6];
         $managemet = $this->model('management')->find($array[array_rand($array,1)]);
       // $managemet = auth()->user()->management;
        $form = ModuleController::form($construccione, $managemet, 'admin.modules.construcciones.store', 'admin.modules.construcciones.update');

        return $this->loadView('Admin.Modules.AnswerTask', $form);
    }

    public function destroy(Construction $construction){}
}
