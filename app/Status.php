<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  protected $table = 'expenditurestatus';

  public $timestamps = false;

  protected $fillable = ['status'];

  public function expenditure()
  {
      return $this->hasMany('App\Expenditure');
  }
}
