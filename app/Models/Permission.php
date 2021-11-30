<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as PackagePermission;
class Permission extends PackagePermission
{
    use HasFactory;

     // Mutators
    public function setNameAttribute($value)
    {
    $this->attributes['name'] = strtoupper($value);
    }
}
