<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as PackageRole;

class Role extends PackageRole
{
    use HasFactory;

    // Mutators
    public function setNameAttribute($value)
    {
$this->attributes['name'] = strtoupper($value);
    }
}
