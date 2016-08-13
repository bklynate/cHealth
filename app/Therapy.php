<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Therapy extends Model
{
    protected $table = 'therapies';

    protected $fillable = [
        'onPatient', 'therapy', 'date', 'from_user'
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
