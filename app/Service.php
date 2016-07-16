<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service', 'cost', 'status', 'createdBy', 'updatedBy'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User','from_user');
  	}

}
