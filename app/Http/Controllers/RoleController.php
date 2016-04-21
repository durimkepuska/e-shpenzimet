<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use Auth;
use Redirect;
use App\Expenditure;
use App\User;
use App\Payment_source;
use App\Spendingtype;
use Flash;
use DB;
use App\Http\Requests\RoleRequest;
use Input;

class RoleController extends Controller
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
    $data = Role::OrderBy('id','dsc')->paginate(10);
    return view('roles.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('roles.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(RoleRequest $request)
  {
    Role::create($request->all());
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
    $data = Role::findOrFail($id);
    return view('roles.show',compact('data'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Role::findOrFail($id);
    return view('roles.edit',compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update($id, RoleRequest $request)
  {
    $role = Role::findOrFail($id);
    $role->update($request->all());
    Flash::warning('U regjistrua me sukses!');
    return redirect('roles');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $role = Role::findOrFail($id);
    $role->delete();
    Flash::warning('Eshte fshire me sukses!');
    return Redirect::back();
  }

  public function search()
  {
    $keyword=  Input::get('keyword');
    $data = Role::where('role', 'LIKE', '%'.$keyword.'%')->paginate();
    return view('roles.index',compact('data'));
  }
}
