<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use App\User;
use Flash;
use DB;
use App\Spendingtype;
use App\Http\Requests\SpendingtypeRequest;
use Input;


class SpendingtypeController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
       $this->middleware('admin', ['only'=>['destroy','update','create','store']]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $data = Spendingtype::paginate(10);
      return view('spendingtypes.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('spendingtypes.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(SpendingtypeRequest $request)
  {
    Spendingtype::create($request->all());
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
    $data = Spendingtype::findOrFail($id);
    return view('spendingtypes.show',compact('data'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Spendingtype::findOrFail($id);
    return view('spendingtypes.edit',compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update($id, SpendingtypeRequest $request)
  {
    $spendingtype = Spendingtype::findOrFail($id);
    $spendingtype->update($request->all());
    Flash::warning('U regjistrua me sukses!');
    return redirect('spendingtypes');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $spendingtype = Spendingtype::findOrFail($id);
    $spendingtype->delete();
    Flash::warning('Eshte fshire me sukses!');
    return Redirect::back();
  }

  public function search()
  {
    $keyword=  Input::get('keyword');
    $data = Spendingtype::where('spendingtype', 'LIKE', '%'.$keyword.'%')->paginate();
    return view('spendingtypes.index',compact('data'));
  }
}
