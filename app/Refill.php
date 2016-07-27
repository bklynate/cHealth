<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refill extends Model
{
    protected $fillable = [
        'drugId', 'drugName', 'formulation', 'description', 'quantity', 'expiryDate', 'createdBy'
    ];
}
