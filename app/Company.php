<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'logo', 'description', 'url'
    ];

    public function users()
    {
        return $this->hasMany('App\User','company_id','id');
    }


}
