<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'identification', 'firstName', 'medId', 'middleName', 'lastName', 'dateOfBirth', 'estimatedAge', 'gender',
        'patientPhone', 'kinPhone', 'email', 'residence', 'county', 'countryOrigin', 'createdBy',
    ];

}
