<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\Expenditure;
use App\User;
use App\Department;
use App\Supplier;
use App\Payment_source;
use App\SpendingCategory;
use App\Spendingtype;
use App\Http\Requests;
use Flash;
use DB;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Requests\ExpendituresRequest;
use App\Http\Requests\RaportRequest;
use App\Http\Controllers\Controller;
use Input;
use Excel;
use App\Type;
use Mail;
class ExpenditureController extends Controller
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
      if(Auth::user()->role_id==4){
        $data = Expenditure::NotHidden()->paginate(10);
      } else {
        $data = Expenditure::DepartmentFilter()->NotHidden()->paginate(10);
      }
      return view('expenditures.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spendingtype = Spendingtype::lists('spendingtype', 'id');
        $spendingcategory = SpendingCategory::lists('spending_category', 'id');
        $supplier = Supplier::lists('supplier', 'id');
        $payment_source = Payment_source::lists('payment_source', 'id');
        $status = Status::lists('status', 'id','desc');

        return view('expenditures.create',compact('spendingtype','supplier','payment_source','spendingcategory','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpendituresRequest $request)
    {

       Auth::user()->expenditure()->create($request->all());
        Flash::warning('U regjistrua me sukses!');
        return redirect('expenditures');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
       $data = Expenditure::findOrFail($id);
        if($this->DeprtmentIsResponsible($id)){
            return view('expenditures.show',compact('data'));
        } else {
            Flash::warning('Nuk keni qasje ne shpenzimet e drejtorive te tjera!');
         return Redirect::back();
        }
     }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Expenditure::findOrFail($id);

      if($this->DeprtmentIsResponsible($id)){

        $spendingtype = Spendingtype::lists('spendingtype', 'id');
        $supplier = Supplier::lists('supplier', 'id');
        $spendingcategory = SpendingCategory::lists('spending_category', 'id');
        $payment_source = Payment_source::lists('payment_source', 'id');
        $status = Status::lists('status', 'id');
        return view('expenditures.edit', compact('spendingtype','supplier','payment_source','data','spendingcategory','status'));

      }
        Flash::warning('Nuk keni qasje ne shpenzimet e drejtorive te tjera!');
        return Redirect::back();
     }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, ExpendituresRequest $request)
    {

        $article = Expenditure::findOrFail($id);

        $article->update($request->all());
        Flash::warning('U regjistrua me sukses!');
        return redirect('expenditures');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Expenditure::findOrFail($id);
        $article->delete();
        Flash::warning('Eshte fshire me sukses!');
      //  return redirect('expenditures');
        return Redirect::back();
    }

    public function DeprtmentIsResponsible($id){

      $data = Expenditure::findOrFail($id);

      if($data->department_id==Auth::User()->department_id || Auth::user()->role_id==4){

        return true;
      } else {
        return false;
      }
    }

    public function depts()
    {
      $data = Expenditure::DepartmentFilter()->NotHidden()->Depts()->paginate(10);
      return view('expenditures.index',compact('data'));
    }



    public function paid()
    {
      $data = Expenditure::DepartmentFilter()->NotHidden()->Paid()->paginate(10);
      return view('expenditures.index',compact('data'));
    }

    public function search()
    {
      $keyword=  Input::get('keyword');
      $data = Expenditure::DepartmentFilter()->NotHidden()->where('description', 'LIKE', '%'.$keyword.'%')->paginate(100);
      return view('expenditures.index',compact('data'));
    }

    public function advanceSearch()
    {
      $data = Expenditure::DepartmentFilter()->paginate(10);
      return view('expenditures.index',compact('data'));
    }

    public function pay($id)
    {
      $data = Expenditure::findOrFail($id);
       if($this->DeprtmentIsResponsible($id)){

         DB::table('expenditures')
          ->where('id', $id)
          ->update(array('paid' => 1,'paid_value'=>$data->value));
           Flash::warning('U regjistrua me sukses!');
             return Redirect::back();
       } else {
           Flash::warning('Nuk keni qasje ne shpenzimet e drejtorive te tjera!');
        return Redirect::back();
       }
    }

    public function paysomething()
    {
      $paid_value = Input::get('paid_value');
      $paid_date = Input::get('paid_date');
      $id = Input::get('id');

      $data = Expenditure::findOrFail($id);

       if($this->DeprtmentIsResponsible($id)){

          $paid = 3;
         if($data->value == $data->paid_value + $paid_value){
           $paid = 1;
         }
         $query = DB::table('expenditures')
          ->where('id', $id)
          ->update(array('paid' => $paid,'paid_value'=>$data->paid_value+$paid_value,'payment_date' => $paid_date));

         Flash::warning('U regjistrua me sukses!');

             return Redirect::back();
       } else {
           Flash::warning('Nuk keni qasje ne shpenzimet e drejtorive te tjera!');
        return Redirect::back();
       }
    }

    public function hidde($id)
    {
      $data = Expenditure::findOrFail($id);
       if($this->DeprtmentIsResponsible($id)){

         $user = Auth::user();

         $director = User::where('department_id', Auth::user()->department_id)->where('role_id',2)->first();

         Mail::send('emails.hidden_expenditures', ['director'=> $director,'user' => $user, 'data' => $data], function ($m) use ($user) {

             $m->from('eshpenzimet@gmail.com', 'e-Shpenzimet');
             $director = User::where('department_id', Auth::user()->department_id)->where('role_id',2)->first();
             $m->to($director->email, $director->name)->subject('Lajmerim, eshte fshehur nje shpenzim nga: ' . $user->name);
         });

         DB::table('expenditures')
          ->where('id', $id)
          ->update(array('hidde' => 1));
           Flash::warning('U regjistrua me sukses!');
             return Redirect::back();
       } else {
           Flash::warning('Nuk keni qasje ne shpenzimet e drejtorive te tjera!');
        return Redirect::back();
       }
    }

    public function hidden()
    {
      $data = Expenditure::DepartmentFilter()->Hidde()->paginate(10);
      return view('expenditures.index',compact('data'));
    }

    public function incompleted()
    {
      $data = Expenditure::DepartmentFilter()->NotHidden()->Incompleted()->paginate(10);
      return view('expenditures.index',compact('data'));
    }

    public function notifications()
    {
      $data = Expenditure::DepartmentFilter()->NotHidden()->PayDeptDate()->paginate(10);
      return view('expenditures.index',compact('data'));
    }



    public function raport()
    {
      $spendingtype = Spendingtype::lists('spendingtype', 'id');
      $supplier = Supplier::lists('supplier', 'id');
      $payment_source = Payment_source::lists('payment_source', 'id');
      $user = User::lists('name', 'id');
      $department = Department::lists('department', 'id');
      $spendingcategory = SpendingCategory::lists('spending_category', 'id');
      $type = Type::lists('type', 'type');
      return view('expenditures.raport',compact('spendingtype','supplier','payment_source','data','user','department','spendingcategory','type'));
    }

    public function generateRaport(RaportRequest $request)
    {

      $type = Input::get('type');
      $paid = Input::get('paid');
      $start_date = Input::get('start_date');
      $end_date = Input::get('end_date');
      $supplier_id = Input::get('supplier_id');
      $allSuppliers = Input::get('allSuppliers');
      $spendingtype = Input::get('spendingtype');

      $allSpendingtypes = Input::get('allSpendingtypes');
      $payment_source = Input::get('payment_source');
      $allPaymentSources = Input::get('allPaymentSources');
      $department_id = Input::get('department_id');
      $spendingcategory = Input::get('spendingcategory');
      $allSpendingCategories = Input::get('allSpendingCategories');

      //hidden

      $data = expenditure::Raport($paid, $start_date, $end_date, $supplier_id, $allSuppliers, $spendingtype, $allSpendingtypes, $payment_source, $allPaymentSources, $department_id, $spendingcategory, $allSpendingCategories )
            ->get();



      Excel::create('duro', function($excel) use($data) {

           $excel->sheet( 'duro', function($sheet) use($data) {

              $sheet->fromArray($data);

           });

       })->export($type);

       return redirect('expenditures');
     }


}
