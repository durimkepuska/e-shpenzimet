<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_source extends Model
{
    protected $table = 'payment_sources';

    public $timestamps = false;

    protected $fillable = ['payment_source'];



    public function expenditure()
    {
       return $this->hasOne('App\Expenditure');
    }
}
