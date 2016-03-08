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

class WebController extends Controller
{

    public function index()
    {
      $type = Type::lists('type', 'type');
      $department = Department::lists('department', 'id');

      //Artisan::call('fresko:tedhenat');
      return view('web.index',compact('type','department'));
    }

    public function generateRaport()
    {

      $type = Input::get('type');
      $department_id = Input::get('department');

      $data = expenditure::where('expenditures.department_id' , $department_id)
        ->where('hidde', 0)
        ->join('departments', 'expenditures.department_id', '=', 'departments.id')
        ->join('suppliers', 'expenditures.supplier_id', '=', 'suppliers.id')
        ->join('spendingtypes', 'expenditures.spendingtype_id', '=', 'spendingtypes.id')
        ->join('payment_sources', 'expenditures.payment_source_id', '=', 'payment_sources.id')
        ->join('users', 'expenditures.user_id', '=', 'users.id')
        ->join('expenditurestatus', 'expenditures.paid', '=', 'expenditurestatus.id')
        ->select('expenditures.id',
                 'suppliers.supplier as Furnitori',
                 'expenditures.description as Pershkrimi',
                 'expenditures.invoice_number as Numri_Fatures',
                 'spendingtypes.spendingtype as Lloji_Shpenzimit',
                 'expenditures.value as Vlera',
                 'departments.department as Drejtoria',
                 'users.name as Pergjegjesi',
                 'payment_sources.payment_source as Vija_Buxhetore',
                 'expenditures.expenditure_date as Data_Shpenzimit',
                 'expenditurestatus.status as Statusi')
                 ->get();

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

                    $sheet->setHeight(1, 20);

                    //$sheet->setAllBorders('thin');



                    $sheet->setOrientation('landscape');

                    $sheet->setPageMargin(array(
                        0.25, 0.30, 0.25, 0.30
                    ));

                    $sheet->appendRow(array(
                        '','© e-Shpenzimet','2016', 'Drejtoria per:',$data[0]->Drejtoria, 'Komuna e Gjakoves'
                    ));

            });

         })->export($type);
       }
}
