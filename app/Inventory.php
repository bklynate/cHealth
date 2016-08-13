<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'drugId', 'drugName', 'formulation' ,'description', 'quantity', 'expiryDate'
    ];
}
