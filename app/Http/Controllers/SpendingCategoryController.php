<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SpendingCategory;
use Auth;
use Redirect;
use App\Expenditure;
use App\User;

use App\Payment_source;
use App\Spendingtype;
use Flash;
use DB;
use App\Http\Requests\SpendingCategoryRequest;
use Input;

class SpendingCategoryController extends Controller
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
      $data = SpendingCategory::OrderBy('id','dsc')->paginate(10);
      return view('spending_categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spending_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpendingCategoryRequest $request)
    {
      SpendingCategory::create($request->all());
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
      $data = SpendingCategory::findOrFail($id);
      return view('spending_categories.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = SpendingCategory::findOrFail($id);
      return view('spending_categories.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, SpendingCategoryRequest $request)
    {
      $SpendingCategory = SpendingCategory::findOrFail($id);
      $SpendingCategory->update($request->all());
      Flash::warning('U regjistrua me sukses!');
      return redirect('spending_categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $SpendingCategory = SpendingCategory::findOrFail($id);
      $SpendingCategory->delete();
      Flash::warning('Eshte fshire me sukses!');
      return Redirect::back();
    }

    public function search()
    {
      $keyword=  Input::get('keyword');
      $data = SpendingCategory::where('spending_category', 'LIKE', '%'.$keyword.'%')->paginate();
      return view('spending_categories.index',compact('data'));
    }
}
