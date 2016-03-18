<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Redirect;
use App\Expenditure;
use App\Payment_source;
use App\Spendingtype;
use Flash;
use DB;
use App\Http\Requests\UserRequest;
use Input;
use Mail;
class UserController extends Controller
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
    return view('users.edit',compact('data'));
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
    $User = User::findOrFail($id);
    $User->update($request->all());
    Flash::warning('U regjistrua me sukses!');
    return redirect('users');
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
    $data = User::where('User', 'LIKE', '%'.$keyword.'%')->paginate();
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
