<?php

namespace App\Http\Controllers\Admin\Modules;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;

class PlanificationModule extends BaseController
{
	public function index()
	{
		$planifications = $this->model('planification')->select([
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

		->paginate(5);       
	return $this->loadView('Admin.Modules.Planifications.index', compact('planifications'));
	}
}
