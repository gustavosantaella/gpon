<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relations

    public function lines()
    {
        return $this->morphMany(AnswerLine::class, 'line');
    }
    // Scopes

    public function scopeGet_management($query, int $id)
    {
        return $query->whereManagement_id($id);
    }
}
