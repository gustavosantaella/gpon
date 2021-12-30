<?php

namespace App\Http\Controllers\Admin\Modules;

use Exception;
use App\Models\Planification;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;


class PlanificationModule extends BaseController
{
    public static function list(int $id = null)
    {
        $query =  $id ? Planification::find($id) : Planification::query();

        $query->select([
            'planifications.*',
            'parishes.id as parishId',
            'parishes.name as parishName',
            'municipalities.id as munId',
            'municipalities.name as munName',
            'states.id as stateid',
            'states.name as stateName'
        ]);


        $query->join('parishes', 'parishes.id', 'planifications.parish_id')
            ->join('municipalities', 'municipalities.id', 'parishes.municipality_id')
            ->join('states', 'states.id', 'municipalities.state_id')
            ->orderBy('id', 'desc');

        return $id ? $query : $query->paginate(5);
    }
    public function index()
    {
        $planifications = self::list();
        return $this->loadView('Admin.Modules.Planifications.index', compact('planifications'));
    }

    public function store()
    {
        $request = $this->request();
        $request->validate([
            'parish_id' => ['required', 'numeric'],
            'municipality_id' => ['required', 'numeric'],
            'state_id' => ['required', 'numeric'],
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
            'name'
        ]);
        $this->model('planification')->create($request);

        return back()->with('status', 200);
    }

    public function show(Planification $planificacione)
    {
        $planification = $planificacione;
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
            $planificacione->update();
            $managements = $this->model('management')->whereConstruction(true)->get()->map(function ($value, $key) {
                return $value->id;
            });
            switch ($request['approved']) {
                case 'APROBADO':

                    $construction = $planificacione->construction()->create();
                    $construction->managements()->attach($managements);
                    return back()->with('status', 200);
                    break;
                case 'RECHAZADO':

                    return back()->with('status', 200);
                    break;
                case 'POR REVISAR':

                break;
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
