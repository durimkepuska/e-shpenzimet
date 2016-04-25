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
use App\Sub_budget;
use Input;
use App\SubBudgetContainer;
class SubBudgetContainerController extends Controller

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
        $departemnt_id = Auth::user()->department_id;
        $sub_budget = SubBudgetContainer::OrderBy('id','asc')->DepartmentFilter()->get();

        $actual_budget =  DB::select(DB::raw('SELECT
                  	vlera_nen_buxhetit - vlera_shpenzimeve AS y, department, spendingtype, sub_budget, payment_source
                  FROM
                  	(
                  		SELECT
                  			sum(VALUE) AS vlera_nen_buxhetit,
                        xxl_departments.department as department,
                  			xxl_spendingtypes.spendingtype as spendingtype,
                  			xxl_sub_budget.sub_budget as sub_budget,
                  			xxl_payment_sources.payment_source as payment_source,
	                      xxl_departments.id AS department_id1,
                  			xxl_sub_budget.id as sub_budget_id1,
                  			xxl_spendingtypes.id AS spendingtype_id1,
                  			xxl_payment_sources.id as payment_source_id1
                  		FROM
                  			xxl_sub_budget_container
                  		RIGHT JOIN xxl_departments ON xxl_sub_budget_container.department_id = xxl_departments.id
                  		RIGHT JOIN xxl_spendingtypes ON xxl_sub_budget_container.spendingtype_id = xxl_spendingtypes.id
                  		RIGHT JOIN xxl_payment_sources ON xxl_sub_budget_container.payment_source_id = xxl_payment_sources.id
                  		RIGHT JOIN xxl_sub_budget ON xxl_sub_budget_container.sub_budget_id = xxl_sub_budget.id
                  		GROUP BY
                  			spendingtype_id1,
                  			payment_source_id1,
                  			sub_budget_id1
                  		ORDER BY
                  			sub_budget_id1
                  	) AS tbl1,
                  	(
                  		SELECT
                  			sum(paid_value) AS vlera_shpenzimeve,

                  			xxl_departments.id AS department_id2,
                  			xxl_spendingtypes.id AS spendingtype_id2,
                  			xxl_sub_budget.id as sub_budget_id2,
                  			xxl_payment_sources.id as payment_source_id2
                  		FROM
                  			xxl_expenditures
                  		RIGHT JOIN xxl_departments ON xxl_expenditures.department_id = xxl_departments.id
                  		RIGHT JOIN xxl_spendingtypes ON xxl_expenditures.spendingtype_id = xxl_spendingtypes.id
                  		RIGHT JOIN xxl_payment_sources ON xxl_expenditures.payment_source_id = xxl_payment_sources.id
                  		RIGHT JOIN xxl_sub_budget ON xxl_expenditures.sub_budget_id = xxl_sub_budget.id
                  		GROUP BY
                  			spendingtype_id2,
                  			payment_source_id2,
                  			sub_budget_id2
                  		ORDER BY
                  			sub_budget_id2
                  	) AS tbl2
                  WHERE
                  	department_id1 = 1 AND department_id2 = 1
                  AND spendingtype_id1 = spendingtype_id2
                  AND payment_source_id1 = payment_source_id2
                  AND sub_budget_id1 = sub_budget_id2
                  GROUP BY
                  	sub_budget,
                  	spendingtype,
                  	payment_source;'));

        $spendings = DB::table('expenditures')
                ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                ->rightjoin('sub_budget', 'sub_budget.id', '=', 'expenditures.sub_budget_id')
                ->rightjoin('payment_sources', 'payment_sources.id', '=', 'expenditures.payment_source_id')
                ->select('sub_budget.sub_budget', 'spendingtypes.spendingtype','payment_sources.payment_source',DB::raw('SUM(paid_value) as total'))
                ->groupBy('spendingtypes.spendingtype')->groupBy('expenditures.payment_source_id')->groupBy('expenditures.sub_budget_id')
                ->where('expenditures.department_id',$departemnt_id)->where('paid','!=',4)
                ->OrderBy('expenditures.id','asc')
                ->get();



        return view('sub_budget_container.home', compact('sub_budget','spendings','actual_budget'));
    }

    public function index()
    {
        $data = SubBudgetContainer::OrderBy('id','dsc')->DepartmentFilter()->paginate(20);
        return view('sub_budget_container.index', compact('data'));
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
      $sub_budget = Sub_budget::orderBy('id')->where('department_id',Auth::user()->department_id)->lists('sub_budget', 'id','desc');

      return view('sub_budget_container.create',compact('spendingtype','payment_source','sub_budget'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      SubBudgetContainer::create($request->all());
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
      $sub_budget = Sub_budget::lists('sub_budget', 'id');

      $data = SubBudgetContainer::findOrFail($id);
      return view('sub_budget_container.edit',compact('spendingtype','payment_source','data','sub_budget'));
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
      $budget = SubBudgetContainer::findOrFail($id);
      $budget->update($request->all());
      Flash::warning('U regjistrua me sukses!');
      return redirect('sub_budget_container');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $budget = SubBudgetContainer::findOrFail($id);
      $budget->delete();
      Flash::warning('Eshte fshire me sukses!');
      return Redirect::back();
    }

    public function addsub_budget()
    {
      $value = Input::get('value');
      $id = Input::get('id');

      if ($value<=0){
        Flash::warning('Vlera duhet te jete me e madhe se zero.');
        return Redirect::back();
      }

      $budget = SubBudgetContainer::findOrFail($id);

      $query = DB::table('sub_budget_container')
       ->where('id', $id)
       ->update(array('value'=>$budget->value+$value));

      Flash::warning('Buxheti eshte shtuar me sukses!');
      return Redirect::back();
    }



}
