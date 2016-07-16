<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'identification', 'firstName', 'medId', 'middleName', 'lastName', 'dateOfBirth', 'estimatedAge', 'gender',
        'patientPhone', 'kinPhone', 'email', 'residence', 'county', 'countryOrigin', 'createdBy',
    ];

    public function vitals()
  	{
    	return $this->hasMany('App\Vital','onPatient');
  	}


    // returns the instance of the user who is author of that vital
    public function author()
    {
        return $this->belongsTo('App\User','id');
    }
  	
}
