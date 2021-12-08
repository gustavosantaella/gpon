<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function municipalities()
	{
		return $this->hasMany(Municipality::class, 'state_id', 'id');
	}

	public function cities()
	{
		return $this->hasMany(City::class, 'city_id', 'id');
	}
}
