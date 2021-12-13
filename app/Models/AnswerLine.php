<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UpdateOrCreateOnNull;
class AnswerLine extends Model
{
    use HasFactory, UpdateOrCreateOnNull;

    protected $guarded = [];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }


}
