<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function planification()
    {
        return $this->belongsTo(Planification::class);
    }
}