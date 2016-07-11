<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'medId', 'patient', 'doctor', 'service', 'cost', 'provider', 'createdBy'
    ];
}
