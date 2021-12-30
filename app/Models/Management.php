<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UpdateOrCreateOnNull;
class Management extends Model
{
    use HasFactory, HasRoles, LaravelPermissionToVueJS,UpdateOrCreateOnNull;

    protected $guarded = [];

    public $table = 'managements';

    // Relations
    public function tasks()
    {
        return $this->hasMany(Task::class, 'management_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'management_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_managements', 'management_id', 'user_id', 'id', 'id', 'management');
    }

    // Scopes
    public function scopeFindByName($query, $name)
    {
        $upperName = Str::upper($name);
        return $query->whereName($upperName)->first() ?? null;

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

    public function setAcronymAttribute(string $acronym)
    {
        $this->attributes['acronym'] = Str::upper($acronym);
    }

}
