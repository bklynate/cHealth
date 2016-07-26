<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refill extends Model
{
    protected $fillable = [
        'name', 'formulation', 'quantity', 'expiryDate'
    ];
}
