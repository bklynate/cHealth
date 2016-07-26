<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispensation extends Model
{
    protected $fillable = [
        'medId', 'onPatient', 'from_user', 'prescription', 'description', 'from_date',
        'to_date', 'quantity_dispensed','quantity_left','status'
    ];
}
