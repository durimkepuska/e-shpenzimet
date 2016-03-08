<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;

    protected $fillable = ['department'];

    protected $table = 'departments';



    public function user()
    {
        return $this->hasMany('App\User');
    }
}
