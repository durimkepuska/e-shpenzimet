<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spendingtype extends Model
{
  protected $table = 'spendingtypes';

  public $timestamps = false;

  protected $fillable = ['spendingtype'];

  public function expenditure()
  {
     return $this->hasMany('App\Expenditure');
  }
}
