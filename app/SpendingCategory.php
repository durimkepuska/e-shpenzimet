<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpendingCategory extends Model
{
  protected $table = 'spending_categories';

  public $timestamps = false;

  protected $fillable = ['spending_category'];

  public function expenditure()
  {
     return $this->hasMany('App\Expenditure');
  }
}
