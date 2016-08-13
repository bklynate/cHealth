<?php

namespace App;
use App\Role;
use App\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'fullname', 'username', 'password', 'staffId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }
        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function patients()
    {
        return $this->hasMany('App\Patient','id');
    }

    public function vitals()
    {
        return $this->hasMany('App\Vital','from_user');
    }

<<<<<<< HEAD
    public function diagnosis()
    {
        return $this->hasMany('App\Diagnosis','from_user');
    }

    public function immunizations()
    {
        return $this->hasMany('App\Immunization','from_user');
    }

    public function therapies()
    {
        return $this->hasMany('App\Therapy','from_user');
    }

    public function procedures()
    {
        return $this->hasMany('App\Procedure','from_user');
    }

    public function histories()
    {
        return $this->hasMany('App\History','from_user');
    }
=======
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074

}
