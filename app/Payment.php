<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
	protected $fillable = [
        'medId', 'drugId', 'patient', 'status', 'cost', 'serviceType', 'receivedBy'
    ];

}
