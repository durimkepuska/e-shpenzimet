<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\Expenditure;
use App\User;
use App\Department;
use App\Supplier;
use App\Sub_budget;
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
use App\Http\Requests\ZotimetRequest;
use App\Http\Controllers\Controller;
use Input;
use Excel;
use App\Type;
use Mail;
class ExpenditureController extends Controller
{

     public function __construct(){

       $this->middleware('auth');

     }
     public function zotimet_edit($id){

         $data = Expenditure::findOrFail($id);

         $spendingtype = Spendingtype::lists('spendingtype', 'id');
         $payment_source = Payment_source::lists('payment_source', 'id');

         return view('zotimet.zotimet_edit', compact('spendingtype','payment_source','data'));
     }

    public function azhurozotim($id, ExpendituresRequest $request){

        $article = Expenditure::findOrFail($id);

        $article->update($request->all());
        Flash::warning('U regjistrua me sukses!');
        return redirect('zotimet');

    }
     public function zotimet(){

       if(Auth::user()->role_id==4){
         $data = Expenditure::NotHidden()->Paraqit_Zotimet()->where('paid',4)->Listoj_te_rejat()->paginate(10);
       } else {
         $data = Expenditure::DepartmentFilter()->Paraqit_Zotimet()->NotHidden()->Listoj_te_rejat()->paginate(10);
       }
       return view('zotimet.zotimet',compact('data'));
     }

     public function zotimet_create(){
       $spendingtype = Spendingtype::lists('spendingtype', 'id');
         $payment_source = Payment_source::lists('payment_source', 'id');

       return view('zotimet.zotimet_create', compact('spendingtype','payment_source'));

     }

     public function zotimet_store(ZotimetRequest $request)
     {

        Auth::user()->expenditure()->create($request->all());
         Flash::warning('U regjistrua me sukses!');
         return redirect('zotimet');
     }

     public function zotimet_show($id){

       $data = Expenditure::findOrFail($id);
        if($this->DeprtmentIsResponsible($id)){
            return view('zotimet.zotimet_show',compact('data'));
        } else {
            Flash::warning('Nuk keni qasje ne shpenzimet e drejtorive te tjera!');
         return Redirect::back();
        }

     }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      if(Auth::user()->role_id==4){
        $data = Expenditure::NotHidden()->Mos_Paraqit_Zotimet()->Listoj_te_rejat()->paginate(10);
      } else {
        $data = Expenditure::DepartmentFilter()->Mos_Paraqit_Zotimet()->NotHidden()->Listoj_te_rejat()->paginate(10);
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
        $spendingtype = Spendingtype::orderBy('spendingtype')->lists('spendingtype', 'id');
        $spendingcategory = SpendingCategory::orderBy('spending_category')->lists('spending_category', 'id');
        $supplier = Supplier::orderBy('supplier')->lists('supplier', 'id');
        $payment_source = Payment_source::orderBy('payment_source')->lists('payment_source', 'id');
        $status = Status::orderBy('status')->lists('status', 'id','desc');
        $sub_budget = Sub_budget::orderBy('id')->where('department_id',Auth::user()->department_id)->lists('sub_budget', 'id','desc');

        return view('expenditures.create',compact('spendingtype','supplier','payment_source','spendingcategory','status','sub_budget'));
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
        $sub_budget = Sub_budget::orderBy('sub_budget')->where('department_id',Auth::user()->department_id)->lists('sub_budget', 'id','desc');
        return view('expenditures.edit', compact('spendingtype','supplier','payment_source','data','spendingcategory','status','sub_budget'));

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
      $data = Expenditure::DepartmentFilter()->NotHidden()->where('invoice_number', 'LIKE', '%'.$keyword.'%')->paginate(10);
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
      $paid_date =  date('Y-m-d');
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

        //  $user = Auth::user();
         //
        //  $director = User::where('department_id', Auth::user()->department_id)->where('role_id',2)->first();
         //
        //  Mail::send('emails.hidden_expenditures', ['director'=> $director,'user' => $user, 'data' => $data], function ($m) use ($user) {
         //
        //      $m->from('eshpenzimet@gmail.com', 'e-Shpenzimet');
        //      $director = User::where('department_id', Auth::user()->department_id)->where('role_id',2)->first();
        //      $m->to($director->email, $director->name)->subject('Lajmerim, eshte fshehur nje shpenzim nga: ' . $user->name);
        //  });

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

    public function unhidde($id)
    {
      $data = Expenditure::findOrFail($id);
       if($this->DeprtmentIsResponsible($id)){

        DB::table('expenditures')
          ->where('id', $id)
          ->update(array('hidde' => 0));
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
      $sub_budget = Sub_budget::lists('sub_budget', 'id');

      return view('expenditures.raport',compact('sub_budget','spendingtype','supplier','payment_source','data','user','department','spendingcategory','type'));
    }

    public function generateRaport(RaportRequest $request)
    {
      $sub_budget = Input::get('sub_budget');
      $allsubbudgets = Input::get('allsubbudgets');
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



      $data = expenditure::Raport($paid, $start_date, $end_date, $supplier_id, $allSuppliers, $spendingtype, $allSpendingtypes, $payment_source, $allPaymentSources, $department_id, $spendingcategory, $allSpendingCategories, $sub_budget, $allsubbudgets )
            ->get();

            if(count($data)==0){
              Flash::warning('Nuk ka shënime!');
               return Redirect::back();
            }

            Excel::create($data[0]->Drejtoria, function($excel) use($data) {

              $excel->setTitle('e-Shpenzimet, '. $data[0]->Drejtoria);

              $excel->setCreator('KrijonXXL')->setCompany('Komuna e Gjakovës');

              $excel->sheet('Drejtoria IT', function($sheet) use($data) {

                       $sheet->fromArray($data);

                       $sheet->row(1, function($row) {

                           $row->setBackground('#ff4d4d');

                       });

                       $sheet->setAutoSize(true);

                       $sheet->freezeFirstRow();

                       $sheet->setAutoFilter();

                       $sheet->setHeight(1, 30);

                       //$sheet->setAllBorders('thin');

                       $sheet->setOrientation('landscape');

                       $sheet->setPageMargin(array(
                           0.25, 0.30, 0.25, 0.30
                       ));

                       $sum1=0;$sum2=0;
                       foreach ($data as $key => $value) {
                         $sum1 = $sum1  +  $data[$key]->Vlera_Faturës;
                         $sum2 = $sum2  +  $data[$key]->Vlera_e_Paguar;
                       }

                       $sheet->appendRow(array(
                           '© e-Shpenzimet 2016','','', '','', 'Gjithsej: ', number_format($sum1,2) . ' EUR', number_format($sum2,2) . ' EUR', number_format($sum1-$sum2,2). ' EUR'
                       ));

                       $sheet->appendRow(array(

                          'Raport prej datës: '.date_format(date_create(Input::get('start_date')), 'd-m-Y')   .' deri me: '.date_format(date_create(Input::get('end_date')), 'd-m-y') ,'','', '',' ', '', '',
                       ));
                       $sheet->appendRow(array(
                            'Drejtoria per: '.$data[0]->Drejtoria
                       ));
                  });

            })->export($type);

       return redirect('expenditures');
     }


}
