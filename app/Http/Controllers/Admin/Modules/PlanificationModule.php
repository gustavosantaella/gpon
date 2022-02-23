<?php

namespace App\Http\Controllers\Admin\Modules;

use Exception;
use App\Models\User;
use App\Models\Planification;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\Technology;
use App\Notifications\StatusPlanificationNotify;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use PhpParser\Node\Stmt\TryCatch;

class PlanificationModule extends BaseController
{
    public static function list(int $id = null)
    {
        $query =  $id ? Planification::find($id) : Planification::query();
        $query->with('parish.municipality.state', 'model', "technology", "file");

        return $id ? $query : $query->paginate(5);
    }
    public function index()
    {
        $planifications = self::list();
        $technologies = Technology::all();
        return $this->loadView('Admin.Modules.Planifications.index', compact('planifications', 'technologies'));
    }

    public function store()
    {
        $request = $this->request();
        $request->validate([
            'parish_id' => ['required', 'numeric'],
            'municipality_id' => ['required', 'numeric'],
            'model_id' => ['required', 'numeric'],
            'state_id' => ['required', 'numeric'],
            'technology_id' => ['required', 'numeric'],
            'name' => [
                'required', 'string',
                Rule::unique('planifications')->where(function ($query) use ($request) {
                    return $query->whereName($request->name)
                        ->whereParish_id($request->parish_id);
                })
            ]
        ]);
        $request = $this->request()->only([
            'parish_id',
            'name',
            'model_id'
        ]);
       $planification =  $this->model('planification')->create($request);

       $planification->technology()->attach($this->request()->technology_id);

        return back()->with('status', 200);
    }

    public function show(Planification $planificacione)
    {
        $planification = $planificacione->load('construction');
        $answers = $planification->answers()->with(['management.tasks', 'lines.task'])->get();

        return $this->loadView('Admin.Modules.Planifications.show', [
            'answers' => $answers,
            "planification" => $planificacione
        ]);
    }

    public function approved(Planification $planificacione)
    {
        $request = $this->request()->validate([
            'approved' => 'required'
        ]);

        try {

            if ($request['approved'] !==  '')
                $planificacione->status = $request['approved'];
                if($planificacione->construction){
                    return back()->with('warning', 'No se puede rechazar el requerimiento. Ya esta en construccion');
                };
            $planificacione->update();
            $managements = $this->model('management')->whereConstruction(true)->get()->map(function ($value, $key) {
                return $value->id;
            });
            switch ($request['approved']) {
                case 'APROBADO':
                    // $users = (User::whereRelation('management', 'name', 'PLANIFICACIONES')->get());
                    // Notification::send($users, new StatusPlanificationNotify([
                    //     'message' => "requerimiento *APROBADO*",

                    // ]));
                    $construction = $planificacione->construction()->create();
                    $construction->managements()->attach($managements);
                    return back()->with('status', 200);
                    break;
                case 'RECHAZADO':
                    //$planificacione->delete();
                    $users = (User::whereRelation('management', 'name', 'PLANIFICACIONES')->get());
                    // Notification::send($users, new StatusPlanificationNotify([
                    //     'message' => "el requerimiento tiene un status de *$request[approved]* por ende sera eliminado.",

                    // ]));
                    return redirect()->route('admin.modules.planificaciones.index')->with('status', 200);
                    break;
                case 'POR REVISAR':
                    $users = (User::whereRelation('roles', 'name', 'SUPER USUARIO')->get());
                    // Notification::send($users, new StatusPlanificationNotify([
                    //     'message' => "Planificaciones ha solicitado una revision status: $request[approved]",

                    //     'planification' => $planificacione,
                    //     'route' => route('admin.modules.planificaciones.show', [$planificacione])
                    // ]));
                    return back()->with('info', 'Se ha solicitado la revision con exito');
                    break;
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function setDocumentation(Planification $planification )
    {

        try {

            $file  = ($this->request()->all());
            if ($file[0]->extension() !== 'zip' && $file[0]->extension() !== 'rar') return back()->with('error', 'El formato  debe de ser .zip obligatoriamente');
            $url =  $file[0]->store("planifiaciones-$planification->id", 'public');

            $planification->file()->create([
                'file' => "$url"
            ]);
            $users = (User::whereRelation('roles', 'name', 'SUPER USUARIO')->get());
            $message  = "Se ha subido la documentacion de '$planification->name'";
            dd($planification->construction);
          if(!$planification->construction->withTrashed()){

                $message  = "Se ha subido la documentacion y hecho el pase a construccion de '$planification->name'";
                $managements = $this->model('management')->whereConstruction(true)->get()->map(function ($value, $key) {
                    return $value->id;
                });
                $construction = $planification->construction()->create();
                $construction->managements()->attach($managements);
          }
            Notification::send($users, new StatusPlanificationNotify([
                'message' => "$message",

                'planification' => $planification,
                'route' => route('admin.modules.planificaciones.show', [$planification])
            ]));
            return back()->with('status', 200);
        } catch (\Throwable $th) {


        return back()->with('error',$th->getMessage() );
        }
    }
}
