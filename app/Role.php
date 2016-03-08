<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'user_roles';

    public $timestamps = false;

    protected $fillable = ['role'];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
