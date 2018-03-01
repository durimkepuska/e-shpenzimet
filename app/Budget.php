<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Budget extends Model
{
  public $timestamps = true;

  protected $fillable = ['department_id','spendingtype_id','payment_source_id','value'];

  protected $table = 'budget';



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


  public function scopeDepartmentFilter($query){

     $query->where('department_id',Auth::user()->department_id);
  }
  public function value()
  {
      $budget = DB::table('budget')
      ->select( DB::raw('value as total'))
      ->where('department_id', Auth::user()->department_id)
      ->where('spendingtype_id',1)
      ->where('payment_source_id',1)
      ->first();


      if($budget)
       return $budget->total;

     return 0;
  }
}
