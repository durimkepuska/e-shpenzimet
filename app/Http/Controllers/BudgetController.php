<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Budget;
use App\Spendingtype;
use App\Payment_source;
use Flash;
use Redirect;
use App\Expenditure;
use DB;
use Auth;
class BudgetController extends Controller
{

    public function __construct(){

      $this->middleware('auth');
      //$this->middleware('auth', ['only'=>'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $departemnt_id = Auth::user()->department_id;
        $budget = Budget::OrderBy('id','asc')->DepartmentFilter()->get();
        $actual_budget =  DB::select(DB::raw('SELECT
                      vlera_buxhetit - vlera_shpenzimeve as y,spendingtype1
                      from
                      (
                                  SELECT
                                          sum(value) as vlera_buxhetit,
                                          xxl_departments.department as department_name,
                  												xxl_departments.id as department_id1,
																					xxl_spendingtypes.spendingtype as spendingtype1
                                          FROM xxl_budget
                                          RIGHT JOIN xxl_departments
                                          ON xxl_budget.department_id=xxl_departments.id
																					RIGHT JOIN xxl_spendingtypes
                                          ON xxl_budget.spendingtype_id=xxl_spendingtypes.id
                                          GROUP BY spendingtype1, department_id1
                  												ORDER BY spendingtype1
                      ) as tbl1,
                      (
                                          SELECT
                                          sum(paid_value) as vlera_shpenzimeve,
                  												xxl_departments.id as department_id2,
																					xxl_spendingtypes.spendingtype as spendingtype2
                                          FROM xxl_expenditures
                  												RIGHT JOIN xxl_departments
                                          ON xxl_expenditures.department_id=xxl_departments.id
																					RIGHT JOIN xxl_spendingtypes
                                          ON xxl_expenditures.spendingtype_id=xxl_spendingtypes.id
                                          GROUP BY spendingtype2 , department_id2
                  												ORDER BY spendingtype2
                      ) as tbl2
											where department_id1='.$departemnt_id.' and department_id2= '.$departemnt_id.' AND spendingtype1=spendingtype2
                      GROUP BY  spendingtype1;'));

        $spendings = DB::table('expenditures')
                ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                ->select( 'spendingtypes.spendingtype',DB::raw('SUM(paid_value) as total'))
                ->groupBy('spendingtypes.spendingtype')
                ->where('expenditures.department_id',Auth::user()->department_id)->where('paid','!=',4)
                ->OrderBy('expenditures.id','asc')
                ->get();
        $zotimet = DB::table('expenditures')
                ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                ->select( 'spendingtypes.spendingtype',DB::raw('SUM(paid_value) as total'))
                ->groupBy('spendingtypes.spendingtype')
                ->where('expenditures.department_id',Auth::user()->department_id)->where('paid',4)
                ->OrderBy('expenditures.id','asc')
                ->get();



        return view('budget.home', compact('budget','spendings','actual_budget','zotimet'));
    }

    public function index()
    {
        $data = Budget::OrderBy('id','dsc')->DepartmentFilter()->paginate(20);
        return view('budget.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $spendingtype = Spendingtype::lists('spendingtype', 'id');
      $payment_source = Payment_source::lists('payment_source', 'id');

      return view('budget.create',compact('spendingtype','payment_source'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Budget::create($request->all());
      Flash::warning('U regjistrua me sukses!');
      return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $spendingtype = Spendingtype::lists('spendingtype', 'id');
      $payment_source = Payment_source::lists('payment_source', 'id');

      $data = Budget::findOrFail($id);
      return view('budget.edit',compact('spendingtype','payment_source','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $budget = Budget::findOrFail($id);
      $budget->update($request->all());
      Flash::warning('U regjistrua me sukses!');
      return redirect('budget');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $budget = Budget::findOrFail($id);
      $budget->delete();
      Flash::warning('Eshte fshire me sukses!');
      return Redirect::back();
    }
}
