<?php

namespace App\Http\Controllers\Admin\Modules;

use Illuminate\Support\Str;
use App\Models\Construction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class ConstructionController extends BaseController
{
    public function index(Request $request)
    {

        $query = Construction::query();


        $query->with(['answers', 'managements', 'managements.answers' => function($query){
            
        }, 'planification' => function ($builder) use ($request) {

                return $builder->where('name', 'like', '%' . Str::upper($request->text) . '%');
            }, 'planification.parish.municipality.state']);

        $construction = $query->get();

	$managements =
	       
	$this->model('management')->whereConstruction(true)->with(['answers'])->get();


        return  $this->loadView('Admin.Modules.Construction.index', compact('construction', 'managements'));
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

    public function show(Construction $construccione)
    {
        $construction = $construccione->load(['managements.tasks','planification.parish.municipality.state', 'answers.lines.task', 'answers.management']);
        $managements = $this->model('management')->whereConstruction(true)->with(['answers', 'tasks'])->get();
        $porcent = request()->porcent;
        return $this->loadView('Admin.Modules.Construction.show', compact('construction', 'managements', 'porcent'));
    }

    public function update()
    {
        try {
            $request = $this->request();

            $planification = $this->model('construction')->findOrFail($request->parent_id);

            $answer = $planification->answers()->findOrfail($request->answer_id);
            $module = new ModuleController();

            $status =  $module->update($planification, $answer);
            if ($status) {

                return redirect()->route('admin.modules.construcciones.index')->with('status', 200);
            }
        } catch (\Throwable $th) {

            return back()->with("error", "Por favor comuniquese con soporte... Mensaje: {$th->getMessage()}");
        }
    }

    public function edit(Construction $construccione)
    {

        $array = [6,7,8,9];
        $managemet = $this->model('management')->find($array[array_rand($array, 1)]);
        // $managemet = auth()->user()->management;
        if (!$managemet->construction) return back();
        $form = ModuleController::form($construccione, $managemet, 'admin.modules.construcciones.store', 'admin.modules.construcciones.update');

        return $this->loadView('Admin.Modules.AnswerTask', $form);
    }

    public function destroy(Construction $construccione)
    {
        try {
            $construccione->delete();
            return back()->with("status", 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
