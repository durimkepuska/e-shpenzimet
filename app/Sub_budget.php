<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_budget extends Model
{
  protected $table = 'sub_budget';

  public $timestamps = false;

  protected $fillable = ['sub_budget','department_id'];

  public function expenditure()
  {
     return $this->hasOne('App\Expenditure');
  }
}
