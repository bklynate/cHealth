<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
    protected $fillable = [
        'onPatient', 'from_user', 'weight', 'height', 'bmi', 'bloodPressure', 'pulse', 'temperature',
    ];

    public function author()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	// returns patient of any vital
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','onPatient');
  	}

}
