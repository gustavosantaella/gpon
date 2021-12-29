<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relations

    public function lines()
    {
        return $this->belongsTo(AnswerLine::class, 'task_id');
    }

    // Mutators

    public function setTitleAttribute(string $title)
    {
        $this->attributes['titl'] = Str::upper($title);
    }
}
