<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient', 'medId', 'doctor', 'status', 'createdBy'
    ];

}
