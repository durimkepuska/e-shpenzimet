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
use App\Department;
use App\Http\Requests\DepartmentRequest;
use Input;

class DepartmentController extends Controller
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
    public function index()
    {
        $data = Department::paginate(10);
        return view('departments.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
      Department::create($request->all());
      Flash::warning('U regjistrua me sukses!');
      return redirect('departments');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data = Department::findOrFail($id);
      return view('departments.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Department::findOrFail($id);
      return view('departments.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, DepartmentRequest $request)
    {
      $department = Department::findOrFail($id);
      $department->update($request->all());
      Flash::warning('U regjistrua me sukses!');
      return redirect('departments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $department = Department::findOrFail($id);
      $department->delete();
      Flash::warning('Eshte fshire me sukses!');
      return Redirect::back();
    }

    public function search()
    {
      $keyword=  Input::get('keyword');
      $data = Department::where('department', 'LIKE', '%'.$keyword.'%')->paginate();
      return view('departments.index',compact('data'));
    }
}
