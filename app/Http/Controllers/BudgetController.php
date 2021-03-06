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
use Input;
use App\Http\Requests\BudgetRequest;
class BudgetController extends Controller
{

    public function __construct(){

      $this->middleware('auth');
      $this->middleware('admin', ['only'=>['destroy']]);
      //$this->middleware('auth', ['only'=>'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $year = date('Y');
        $departemnt_id = Auth::user()->department_id;
        $budget = Budget::OrderBy('id','asc')->DepartmentFilter()->Where('year', '=', $year)->get();
        $actual_budget =  DB::select(DB::raw('
                        SELECT
                            vlera_buxhetit - vlera_shpenzimeve AS y,
                            spendingtype1,
                            payment_source
                        FROM
                            (
                                SELECT
                                    sum(VALUE) AS vlera_buxhetit,
                                    xxl_departments.department AS department_name,
                                    xxl_departments.id AS department_id1,
                                    xxl_spendingtypes.spendingtype AS spendingtype1,
                                    xxl_payment_sources.payment_source,
                                    xxl_budget.payment_source_id AS payment1
                                  
                                FROM
                                    xxl_budget
                                RIGHT JOIN xxl_payment_sources ON xxl_budget.payment_source_id = xxl_payment_sources.id
                                RIGHT JOIN xxl_departments ON xxl_budget.department_id = xxl_departments.id
                                RIGHT JOIN xxl_spendingtypes ON xxl_budget.spendingtype_id = xxl_spendingtypes.id
                                where xxl_budget.year= '.$year.'
                                GROUP BY
                                    spendingtype1,
                                    department_id1,
                                    payment1
                                ORDER BY
                                    spendingtype1
                            ) AS tbl1,
                            (
                                SELECT
                                    sum(paid_value) AS vlera_shpenzimeve,
                                    xxl_departments.id AS department_id2,
                                    xxl_spendingtypes.spendingtype AS spendingtype2,
                                    xxl_expenditures.payment_source_id AS payment2
                                FROM
                                    xxl_expenditures
                                RIGHT JOIN xxl_payment_sources ON xxl_expenditures.payment_source_id = xxl_payment_sources.id
                                RIGHT JOIN xxl_departments ON xxl_expenditures.department_id = xxl_departments.id
                                RIGHT JOIN xxl_spendingtypes ON xxl_expenditures.spendingtype_id = xxl_spendingtypes.id
                                where year(xxl_expenditures.created_at)='.$year.'
                                GROUP BY
                                    spendingtype2,
                                    department_id2,
                                    payment2
                                ORDER BY
                                    spendingtype2
                            ) AS tbl2
                        WHERE
                            department_id1 = '.$departemnt_id.'
                        AND department_id2 = '.$departemnt_id.'
                        AND spendingtype1 = spendingtype2
                        AND payment1 = payment2
                       
                        GROUP BY
                            spendingtype1,
                            department_id1,
                            payment_source
                      '));

        $spendings = DB::table('expenditures')
                ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                ->rightjoin('payment_sources', 'payment_sources.id', '=', 'expenditures.payment_source_id')
                ->select( 'spendingtypes.spendingtype','payment_sources.payment_source',DB::raw('SUM(paid_value) as total'))
                ->groupBy('spendingtypes.spendingtype')->groupBy('expenditures.payment_source_id')
                ->where('expenditures.department_id',Auth::user()->department_id)->where('paid','!=',4)
                ->whereYear('expenditures.created_at', '=', $year)
                ->OrderBy('expenditures.id','asc')
                ->get();
        $zotimet = DB::table('expenditures')
                ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                ->rightjoin('payment_sources', 'payment_sources.id', '=', 'expenditures.payment_source_id')
                ->select( 'payment_source','spendingtypes.spendingtype',DB::raw('SUM(paid_value) as total'))
                ->groupBy('spendingtypes.spendingtype')
                ->where('expenditures.department_id',Auth::user()->department_id)->where('paid',4)
                ->whereYear('expenditures.created_at', '=', $year)
                ->OrderBy('expenditures.id','asc')
                ->get();



        return view('budget.home', compact('budget','spendings','actual_budget','zotimet'));
    }

    public function index()
    {

        $data = Budget::OrderBy('year','e')->DepartmentFilter()->paginate(200);
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
    public function store(BudgetRequest $request )
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

    public function addbudget()
    {
      $value = Input::get('value');
      $id = Input::get('id');

      if ($value<=0){
        Flash::warning('Vlera duhet te jete me e madhe se zero.');
        return Redirect::back();
      }

      $budget = Budget::findOrFail($id);

      $query = DB::table('budget')
       ->where('id', $id)
       ->update(array('value'=>$budget->value+$value));

      Flash::warning('Buxheti eshte shtuar me sukses!');
      return Redirect::back();
    }



}
