<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Department;
use Redirect;
use App\Expenditure;
use App\Payment_source;
use App\Spendingtype;
use Flash;
use DB;
use App\Http\Requests\UserRequest;
use Input;
use Mail;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
  public function __construct(){

      $this->middleware('auth');
      $this->middleware('admin', ['only'=>['destroy','update','create']]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = User::OrderBy('id','dsc')->paginate(10);
    return view('users.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('users.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserRequest $request)
  {
    User::create($request->all());
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
    $data = User::findOrFail($id);
    return view('users.show',compact('data'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = User::findOrFail($id);
  
    $departments = Department::orderBy('id')->lists('department', 'id','asc');
    
     // $spendingtype = department::lists('department', 'id');
    
    return view('users.edit',compact('data','departments'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update($id, UserRequest $request)
  {
    $fjalekalimi=  Input::get('fjalekalimi');
    $emri=  Input::get('name');
    $department_id=  Input::get('department_id');
    // var_dump($department_id);
    // die();
    if(strlen($fjalekalimi)<6){
      Flash::warning('Fjalekalimi duhet te jete se paku me 6 karaktere!');
      return redirect::back();
    }
    $hash = Hash::make($fjalekalimi);
    DB::table('users')
            ->where('id', $id)
            ->update(['password' => $hash],['name' => $emri],['department_id' => (int)$department_id]);

    Flash::warning('U regjistrua me sukses!');
    return redirect::back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $User = User::findOrFail($id);
    $User->delete();
    Flash::warning('Eshte fshire me sukses!');
    return Redirect::back();
  }

  public function search()
  {
    $keyword=  Input::get('keyword');
    $data = User::where('name', 'LIKE', '%'.$keyword.'%')->paginate();
    return view('users.index',compact('data'));
  }

  public function sendme()
    {
        $user = User::findOrFail(6);
        $pershkrimi = 'shpenzimi x';
        $vlera_fatures = '500 EUR';
        Mail::send('emails.hidden_expenditures', ['user' => $user, 'pershkrimi' => $pershkrimi, 'vlera_fatures' => $vlera_fatures], function ($m) use ($user) {

            $m->from('durimkepuska@gmail.com', 'e-Shpenzimet');
              $user = User::findOrFail(6);
            $m->to($user->email, $user->name)->subject('Lajmerim, eshte fshehur nje shpenzim nga: ' . $user->name);
        });
    }
}
