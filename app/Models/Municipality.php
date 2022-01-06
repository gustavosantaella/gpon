<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
class Municipality extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function state()
	{
		return $this->belongsTo(State::class,'state_id', 'id');
	}

	public function parishes()
	{
		return $this->hasMany(Parish::class,'municipality_id', 'id');
	}
}
