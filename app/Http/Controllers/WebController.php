<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expenditure;
use App\Type;
use App\Department;
use App\Spendingtype;
use App\Http\Requests;
use App\SpendingCategory;
use App\Http\Controllers\Controller;
use Input;
use Excel;
use Artisan;
use DB;
use Flash;
class WebController extends Controller
{

    public function index()
    {
      $type = Type::lists('type', 'type');
      $department = Department::orderBy('department')->lists('department', 'id');
       $department->prepend('Të gjitha', 0);
      if(isset($_GET['migrate328'])){
        Artisan::call('fresko:tedhenat');
      }
      
      return view('web.index',compact('type','department'));
    }

    public function generateRaport()
    {
     
      $type = Input::get('type');

      $department_id = Input::get('department');

      $data = expenditure::where(function($data) use ($department_id)
      {
          if ($department_id!=0) {
              $data->where('expenditures.department_id' , $department_id);
          }
      })
      // ->where('hidde', 0)->whereYear('expenditures.created_at', '=', "2016")
      ->join('departments', 'expenditures.department_id', '=', 'departments.id')
      ->join('suppliers', 'expenditures.supplier_id', '=', 'suppliers.id')
      ->join('spendingtypes', 'expenditures.spendingtype_id', '=', 'spendingtypes.id')
      ->join('payment_sources', 'expenditures.payment_source_id', '=', 'payment_sources.id')
      ->join('users', 'expenditures.user_id', '=', 'users.id')
      ->join('expenditurestatus', 'expenditures.paid', '=', 'expenditurestatus.id')
      ->join('spending_categories', 'expenditures.spending_category_id', '=', 'spending_categories.id')
      ->select(
               'departments.department as Drejtoria',
               'spendingtypes.spendingtype as Lloji_Shpenzimit',
               'spending_categories.spending_category as Kategoria',
               'suppliers.supplier as Furnitori',
               'expenditures.invoice_number as Numri_Fatures',
               'expenditures.value as Vlera_Faturës',
               'expenditures.paid_value as Vlera_e_Paguar',
                DB::raw('value-paid_value as Borxhi'),
                //'expenditurestatus.status as Statusi',
                'expenditures.expenditure_date as Data_Shpenzimit',
                'expenditures.description as Përshkrimi_Shpenzimit',
                //'users.name as Përgjegjësi',
                'payment_sources.payment_source as Vija_Buxhetore')
               ->get();
               // echo count($data);
               // die();
               if(count($data)==0){
                 Flash::warning('Nuk ka shënime për këtë drejtori!');
                 return redirect('/');
               }

         if($department_id!=0){
            $file_name = $data[0]->Drejtoria;
         } else {
            $file_name= "Të gjitha drejtoritë";
         }
         Excel::create( $file_name, function($excel) use($data, $file_name) {

           $excel->setTitle('e-Shpenzimet, '. $data[0]->Drejtoria);

           $excel->setCreator('Krijon')->setCompany('Komuna e Gjakovës');

           $excel->sheet('Drejtoria IT', function($sheet) use($data, $file_name)  {

                    $sheet->fromArray($data);

                    $sheet->row(1, function($row) {

                        $row->setBackground('#ff4d4d');

                    });

                    $sheet->setAutoSize(true);

                    $sheet->freezeFirstRow();

                    $sheet->setAutoFilter();

                    $sheet->setHeight(1, 20);

                    $sheet->setOrientation('landscape');

                    $sheet->setPageMargin(array(
                        0.25, 0.30, 0.25, 0.40
                    ));

                    $sum1=0;$sum2=0;
                    foreach ($data as $key => $value) {
                      $sum1 = $sum1  +  $data[$key]->Vlera_Faturës;
                      $sum2 = $sum2  +  $data[$key]->Vlera_e_Paguar;
                    }

                    $sheet->appendRow(array(
                        '','','', '','Gjithsej: ', number_format($sum1,2) . ' EUR', number_format($sum2,2) . ' EUR', number_format($sum1-$sum2,2). ' EUR'
                    ));
                    $sheet->appendRow(array(
                        '© e-Shpenzimet'
                    ));

                    $sheet->appendRow(array(
                        'Komuna e Gjakovës'
                    ));
                    $sheet->appendRow(array(
                        'Shpenzimet dhe Borxhet për: '. $file_name
                    ));

                    // $sheet->appendRow(array(
                    //      $data[0]->Drejtoria
                    // ));

                  });

         })->export($type);
       }
}
