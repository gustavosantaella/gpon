<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Models\Planification;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class PlanificationModule extends BaseController
{
    public static function list()
    {
        return Planification::select([
			'planifications.*',
			'parishes.id as parishId',
			'parishes.name as parishName',
			'municipalities.id as munId',
			'municipalities.name as munName',
			'states.id as stateid',
			'states.name as stateName'
		])
						 ->join('parishes','parishes.id','planifications.parish_id')
						 ->join('municipalities','municipalities.id','parishes.municipality_id')
						 ->join('states','states.id','municipalities.state_id')
						 ->orderBy('id','desc')

		->paginate(5);
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
			'parish_id'=>['required','numeric'],
			'municipality_id'=>['required','numeric'],
			'state_id'=>['required','numeric'],
			'name'=>['required','string',
			Rule::unique('planifications')->where(function($query) use($request){
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
}
