<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public $fillable = ['name', 'display_name', 'description'];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function getDisplayNameAttribute()
    {
        return $this->display_name ?? $this->name;
    }
}
