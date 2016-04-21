<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Payment_source;
use Auth;
use Redirect;
use App\Expenditure;
use App\User;
use App\Spendingtype;
use Flash;
use DB;
use App\Http\Requests\PaymentSourceRequest;
use Input;

class PaymentsourceController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
     $this->middleware('admin', ['only'=>['destroy','update']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Payment_source::OrderBy('id','dsc')->paginate(10);
    return view('payment_sources.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('payment_sources.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PaymentSourceRequest $request)
  {
    Payment_source::create($request->all());
    Flash::warning('U regjistrua me sukses!');
    return redirect('payment_sources');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data = Payment_source::findOrFail($id);
    return view('payment_sources.show',compact('data'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Payment_source::findOrFail($id);
    return view('payment_sources.edit',compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update($id, PaymentSourceRequest $request)
  {
    $payment_source = Payment_source::findOrFail($id);
    $payment_source->update($request->all());
    Flash::warning('U regjistrua me sukses!');
    return redirect('payment_sources');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $payment_source = Payment_source::findOrFail($id);
    $payment_source->delete();
    Flash::warning('Eshte fshire me sukses!');
    return Redirect::back();
  }

  public function search()
  {
    $keyword=  Input::get('keyword');
    $data = Payment_source::where('payment_source', 'LIKE', '%'.$keyword.'%')->paginate();
    return view('payment_sources.index',compact('data'));
  }

}
