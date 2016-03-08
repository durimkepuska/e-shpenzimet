<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    public $timestamps = false;

    protected $fillable = ['supplier','address','telephone','fiscal_number','city','country','contact_person','lat','lon'];

    public function scopeDepartmentFilter($query){

       $query->latest('created_at')->where('department_id',Auth::user()->department_id);
    }

    public function expenditure()
    {
        return $this->hasMany('App\Expenditure');
    }

}
