<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class SubBudgetContainer extends Model
{
  public $timestamps = false;

  protected $fillable = ['department_id','spendingtype_id','payment_source_id','sub_budget_id','value'];

  protected $table = 'sub_budget_container';



  public function spendingtype()
  {
     return $this->belongsTo('App\Spendingtype');
  }

  public function payment_source()
  {
     return $this->belongsTo('App\Payment_source');
  }

  public function department()
  {
      return $this->belongsTo('App\Department');
  }

  public function sub_budget()
  {
      return $this->belongsTo('App\sub_budget');
  }


  public function scopeDepartmentFilter($query){

     $query->where('department_id',Auth::user()->department_id);
  }


}
