<?php

namespace App;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
class Expenditure extends Model
{
    protected $table = 'expenditures';

      protected $fillable = ['dept_paid_date','spending_category_id' , 'expenditure_date','description', 'invoice_number', 'spendingtype_id','value','supplier_id','paid','paid_value','payment_source_id','payment_date','department_id'];



    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function status()
    {
        return $this->belongsTo('App\Status','paid');
    }

    public function spendingtype()
    {
       return $this->belongsTo('App\Spendingtype');
    }
    public function payment_source()
    {
       return $this->belongsTo('App\Payment_source');
    }
    public function SpendingCategory()
    {
       return $this->belongsTo('App\SpendingCategory');
    }




    public function scopeDepartmentFilter($query){
      if(Auth::user()->role_id==4){
       $query->latest('created_at');
     } else{
        $query->latest('created_at')->where('department_id',Auth::user()->department_id);
     }

    }

    public function scopeKeywordMatch($query){

       $query->where('description', 'LIKE', '%$keyword%');
    }



    public function scopeIncompleted($query){

     $query->where('paid', 3);
    }

    public function scopePaid($query){

     $query->where('paid', 1);
    }

    public function scopeDepts($query){

      $query->where('paid', 2);
    }



    public function scopeHidde($query){

      $query->where('hidde', 1);
    }

    public function scopeNotHidden($query){

      $query->where('hidde', 0);
    }

    public function notifications(){

      return Expenditure::DepartmentFilter()->where('dept_paid_date', date('Y-m-d'))->count('dept_paid_date');
    }

    public function scopePayDeptDate($query){

        $query->where('dept_paid_date', date('Y-m-d'));

    }
    public function scopeParaqit_Zotimet($query){
        $query->where('paid', 4);
    }
    public function scopeMos_Paraqit_Zotimet($query){
        $query->where('paid','!=', 4);
    }

    public function scopeListoj_te_rejat($query){
          $query->orderBy('created_at','desc');
    }

    public function scopeRaport($query,$paid, $start_date, $end_date, $supplier_id, $allSuppliers, $spendingtype, $allSpendingtypes, $payment_source, $allPaymentSources, $department_id, $spendingcategory, $allSpendingCategories ){

            if($paid==1||$paid==2){$query->where('expenditures.paid' , $paid);}
            if(!$allSuppliers==1){  $query->where('expenditures.supplier_id' , $supplier_id);}
            if(!$allSpendingtypes==1){  $query->where('expenditures.spendingtype_id', $spendingtype);}
            if(!$allPaymentSources==1){  $query->where('expenditures.payment_source_id' , $payment_source);}
            if(!$allSpendingCategories==1){  $query->where('expenditures.spending_category_id' , $spendingcategory);}
              $query->whereBetween('expenditures.expenditure_date',array($start_date,$end_date));
             if(Auth::user()->role_id!==4){ $query->where('expenditures.department_id' , $department_id); }
              $query->join('departments', 'expenditures.department_id', '=', 'departments.id')
              ->join('suppliers', 'expenditures.supplier_id', '=', 'suppliers.id')
              ->join('spendingtypes', 'expenditures.spendingtype_id', '=', 'spendingtypes.id')
              ->join('payment_sources', 'expenditures.payment_source_id', '=', 'payment_sources.id')
              ->join('users', 'expenditures.user_id', '=', 'users.id')
              ->join('expenditurestatus', 'expenditures.paid', '=', 'expenditurestatus.id')
              ->join('spending_categories', 'expenditures.spending_category_id', '=', 'spending_categories.id')
              ->select(
                        'departments.department as Drejtoria',
                        'spendingtypes.spendingtype as Lloji_Shpenzimit',
                        'spending_categories.spending_category as Kategoria',
                        'suppliers.supplier as Furnitori',
                        'expenditures.invoice_number as Numri_Faturës',
                        'expenditures.value as Vlera_Faturës',
                        'expenditures.paid_value as Vlera_e_Paguar',
                         DB::raw('value-paid_value as Borxhi'),
                        'expenditurestatus.status as Statusi',
                        'expenditures.expenditure_date as Data_Shpenzimit',
                        'expenditures.description as Përshkrimi_Shpenzimit',
                        'users.name as Përgjegjësi',
                        'payment_sources.payment_source as Vija_Buxhetore'
                      );
      }


}
