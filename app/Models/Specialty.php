<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class, 'specialist_specialties');
    }
}
