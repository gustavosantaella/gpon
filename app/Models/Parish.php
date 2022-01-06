<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
	use HasFactory;

	public function municipality()
	{
		return $this->belongsTo(Municipality::class, 'municipality_id', 'id');
	}
}
