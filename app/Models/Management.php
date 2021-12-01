<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;

class Management extends Model
{
    use HasFactory, HasRoles;

    protected $guarded = [];

    public $table = 'managements';

    // Relations
    public function tasks()
    {
        return $this->hasMany(Task::class, 'management_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_managements', 'management_id', 'user_id', 'id', 'id', 'management');
    }


}
