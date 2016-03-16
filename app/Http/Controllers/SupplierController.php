<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Supplier;
use Auth;
use Redirect;
use App\Expenditure;
use App\User;
use App\Payment_source;
use App\Spendingtype;
use Flash;
use DB;
use App\Http\Requests\SupplierRequest;
use Input;

class SupplierController extends Controller
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
      $data = Supplier::OrderBy('supplier','asc')->paginate(10);
      return view('suppliers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
      Supplier::create($request->all());
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
      $data = Supplier::findOrFail($id);
      return view('suppliers.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Supplier::findOrFail($id);
      return view('suppliers.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, SupplierRequest $request)
    {
      $supplier = Supplier::findOrFail($id);
      $supplier->update($request->all());
      Flash::warning('U regjistrua me sukses!');
      return redirect('suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $supplier = Supplier::findOrFail($id);
      $supplier->delete();
      Flash::warning('Eshte fshire me sukses!');
      return Redirect::back();
    }

    public function search()
    {
      $keyword=  Input::get('keyword');
      $data = Supplier::where('supplier', 'LIKE', '%'.$keyword.'%')->paginate();
      return view('suppliers.index',compact('data'));
    }
}
