<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Mutators

    public function setTitleAttribute(string $title)
    {
        $this->attributes['titl'] = Str::upper($title);
    }
}
