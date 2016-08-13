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

<<<<<<< HEAD
    public function diagnosis()
    {
      return $this->hasMany('App\Diagnosis','onPatient');
    }

    public function immunizations()
    {
      return $this->hasMany('App\Immunization', 'onPatient');
    }

    public function therapies()
    {
      return $this->hasMany('App\Therapy', 'onPatient');
    }

    public function procedures()
    {
        return $this->hasMany('App\Procedure','onPatient');
    }

=======
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
    public function medication()
    {
      return $this->hasMany('App\Medication','onPatient');
    }

    // returns the instance of the user who is author of that vital
    public function author()
    {
        return $this->belongsTo('App\User','id');
    }
  	
}
