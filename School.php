<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'logo_path'
    ];

    public function campuses()
    {
        return $this->hasMany(Campus::class);
    }

    public function degrees()
    {
        return $this->hasMany(Degree::class);
    }
}
