<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planification extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relations

    public function parish()
    {
        return $this->belongsTo(Parish::class, 'parish_id', 'id');
    }

    public function answers()
    {
        return $this->morphMany(Answer::class, 'answer');
    }

    public function construction()
    {
        return $this->hasOne(Construction::class);
    }


    // Scopes


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
