<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    use HasFactory;
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
}
