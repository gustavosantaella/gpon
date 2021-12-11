<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Planification extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function parish()
	{
		return $this->belongsTo(Parish::class,'parish_id','id');
	}

      // Mutators

    /**
     * Undocumented function
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = Str::upper($name);
    }
}
