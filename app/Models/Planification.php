<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planification extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function parish()
	{
		return $this->belongsTo(Parish::class,'parish_id','id');
	}
}
