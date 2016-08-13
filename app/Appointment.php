<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient', 'medId', 'serviceType', 'status', 'staffId','createdBy'
    ];

}