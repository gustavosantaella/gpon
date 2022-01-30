<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Construction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    // Relations

    public function planification()
    {
        return $this->belongsTo(Planification::class);
    }

    public function managements()
    {
        return $this->belongsToMany(Management::class, 'management_constructions');
    }

    public function answers()
    {
        return $this->morphMany(Answer::class, 'answer');
    }


}
