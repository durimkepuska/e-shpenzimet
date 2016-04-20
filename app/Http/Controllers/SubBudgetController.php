<?php






namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sub_budget;
use Auth;
use Redirect;
use App\Expenditure;
use App\User;
use App\Payment_source;
use App\Spendingtype;
use Flash;
use DB;
use App\Http\Requests\sub_budgetRequest;
use Input;

class SubBudgetController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
      $this->middleware('admin', ['only'=>'destroy']);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Sub_budget::OrderBy('sub_budget','asc')->paginate(10);
    return view('sub_budget.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('sub_budget.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(sub_budgetRequest $request)
  {
    sub_budget::create($request->all());
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
    $data = sub_budget::findOrFail($id);
    return view('sub_budget.show',compact('data'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = sub_budget::findOrFail($id);
    return view('sub_budget.edit',compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update($id, sub_budgetRequest $request)
  {
    $sub_budget = sub_budget::findOrFail($id);
    $sub_budget->update($request->all());
    Flash::warning('U regjistrua me sukses!');
    return redirect('sub_budget');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $sub_budget = sub_budget::findOrFail($id);
    $sub_budget->delete();
    Flash::warning('Eshte fshire me sukses!');
    return Redirect::back();
  }

  public function search()
  {
    $keyword=  Input::get('keyword');
    $data = sub_budget::where('sub_budget', 'LIKE', '%'.$keyword.'%')->paginate();
    return view('sub_budget.index',compact('data'));
  }
}
