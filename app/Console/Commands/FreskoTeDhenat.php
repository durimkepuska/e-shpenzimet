<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Department;
use App\Budget;
use App\Expenditure;
use App\Spendingtype;
use App\SpendingCategory;
use File;
use Storage;
class FreskoTeDhenat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresko:tedhenat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will refresh the spendings data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

      public $name;

    
    public function handle()
    {
      $year = 2017;

      $department = Department::lists('department', 'id');
      $spending_types = Spendingtype::lists('spendingtype', 'id');
      $spending_categories = SpendingCategory::lists('spending_category', 'id');

      //shpenzimet totale
      $shpenzimet_total =  DB::table('expenditures')
              ->select(DB::raw('SUM(paid_value) as total'))->where('paid','!=',4)->whereYear('created_at', '=', $year)
              ->get();
        // var_dump($shpenzimet_total);
        // die();
      File::put(storage_path('charts/'.$year.'/totals/shpenzimet_total.js'), $shpenzimet_total[0]->total);
      //end

      //borxhet totale
      $borxhet_total =  DB::table('expenditures')
              ->select(DB::raw('SUM(value-paid_value) as total'))->where('paid','!=',4)->whereYear('created_at', '=', $year)
              ->get();
      File::put(storage_path('charts/'.$year.'/totals/borxhet_total.js'), $borxhet_total[0]->total);
      //end

      //buxheti total
      $buxheti_total =  DB::table('budget')
              ->select(DB::raw('SUM(value) as total'))
              ->whereYear('created_at', '=', $year)
              ->get();
      File::put(storage_path('charts/'.$year.'/totals/buxheti_total.js'), $buxheti_total[0]->total);
      //end

      //buxheti aktual
      $buxheti_aktual =  $buxheti_total[0]->total - $shpenzimet_total[0]->total;
      File::put(storage_path('charts/'.$year.'/totals/buxheti_aktual.js'), $buxheti_aktual);
      //end

      // buxheti fillestare drejtorite
      $buxheti_fillestare_drejtorite =  DB::table('budget')
              ->join('departments', 'departments.id', '=', 'budget.department_id')
              ->select( DB::raw('CONCAT("buxheti_fillestare","-",department_id) as drilldown'),'departments.department as name', DB::raw('SUM(value) as y'))
              ->whereYear('budget.created_at', '=', $year)
              ->groupBy('budget.department_id')
              ->get();

        $buxheti_fillestare_object = new FreskoTeDhenat();

               $buxheti_fillestare_object->id = 'buxheti_fillestare_drejtorite';
               // $buxheti_fillestare_object->name = 'Këtu është paraqitur buxheti fillestar për çdo drejtori gjatë vitit '.$year.'. Kliko mbi shtylla për më shumë informata';
               $buxheti_fillestare_object->data = $buxheti_fillestare_drejtorite;

        $buxheti_fillestare_json = json_encode ($buxheti_fillestare_object, JSON_NUMERIC_CHECK);

        File::put(storage_path('charts/'.$year.'/all.js'), $buxheti_fillestare_json.',');
        //end

        $file=fopen('../storage/charts/'.$year.'/all.js','a');

        //  buxhetin fillestare drejtorite kategorite
        foreach ($department as  $index =>$value) {

          $data =  DB::table('budget')
                  ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'budget.spendingtype_id')
                  ->select(DB::raw('CONCAT("buxheti_fillestare","-",department_id,"-",spendingtype_id) as drilldown'), 'spendingtypes.spendingtype as name', DB::raw('SUM(value) as y'))
                  ->where('budget.department_id',$index)
                  ->whereYear('budget.created_at', '=', $year)
                  ->groupBy('budget.spendingtype_id')
                  ->get();

          $obj = new FreskoTeDhenat();
                  $obj->id = 'buxheti_fillestare-'.$index;
                  // $obj->name = 'Këtu është paraqitur buxheti fillestar për çdo drejtori i ndarë ne kategori të ndryshme gjatë vitit '.$year.'.';
                  $obj->data = $data;

          $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);

         $this->appendToFile($json_obj, $file);

        }


        // end
                  //buxheti aktual drejtorite
        $data =  DB::select(DB::raw('SELECT
                      CONCAT("buxheti_aktual-",department_id1) as drilldown,
                      vlera_buxhetit - vlera_shpenzimeve as y,
                  		department_name as `name`
                      from
                      (
                                  SELECT
                                          sum(value) as vlera_buxhetit,
                                          xxl_departments.department as department_name,
                  												xxl_departments.id as department_id1
                                          FROM xxl_budget
                                          RIGHT JOIN xxl_departments
                                          ON xxl_budget.department_id=xxl_departments.id
                                          WHERE YEAR(xxl_budget.created_at) = '.$year.'
                                          GROUP BY department_id
                  												ORDER BY department_id
                      ) as tbl1,
                      (
                                          SELECT
                                          sum(paid_value) as vlera_shpenzimeve,
                  												xxl_departments.id as department_id2
                                          FROM xxl_expenditures
                  												RIGHT JOIN xxl_departments
                                          ON xxl_expenditures.department_id=xxl_departments.id
                                          WHERE YEAR(xxl_expenditures.created_at) = '.$year.'
                                          GROUP BY department_id
                  												ORDER BY department_id
                      ) as tbl2

                      where department_id1=department_id2
                      GROUP BY  department_id1, department_id2;'));

                     $obj = new FreskoTeDhenat();

                     $obj->id = 'buxheti_aktual_drejtorite';
                     // $obj->name = 'Këtu është paraqitur buxheti aktual për çdo drejtori gjatë vitit '.$year.'. Kliko mbi shtylla për më shumë informata';
                     $obj->data = $data;

                     $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);
         $this->appendToFile($json_obj, $file);
          //end
                   //buxheti aktual drejtorite kategorite
          foreach ($department as  $index =>$value) {

              $data =  DB::select(DB::raw('SELECT
                      CONCAT("buxheti_aktual","-",department_id1,"-",spendingtype1) as drilldown,
                      vlera_buxhetit - vlera_shpenzimeve as y,
                      spendingtype as `name`
                      from
                      (
                                          SELECT
                                          sum(value) as vlera_buxhetit,
                                          xxl_budget.department_id as department_id1,
                                          xxl_budget.spendingtype_id as spendingtype1,
                                          xxl_spendingtypes.spendingtype as spendingtype
                                          FROM xxl_budget
                                          RIGHT JOIN xxl_departments
                                          ON xxl_budget.department_id=xxl_departments.id
                                          RIGHT JOIN xxl_spendingtypes
                                          ON xxl_budget.spendingtype_id=xxl_spendingtypes.id
                                          WHERE YEAR(xxl_budget.created_at) = '.$year.'
                                          GROUP BY spendingtype1, department_id1

                                    ) as tbl1,
                                    (
                                          SELECT
                                          sum(paid_value) as vlera_shpenzimeve,
                                          xxl_expenditures.department_id as department_id2,
                                          xxl_expenditures.spendingtype_id as spendingtype2
                                          FROM xxl_expenditures
                                          RIGHT JOIN xxl_departments
                                          ON xxl_expenditures.department_id=xxl_departments.id
                                          RIGHT JOIN xxl_spendingtypes
                                          ON xxl_expenditures.spendingtype_id=xxl_spendingtypes.id
                                          where xxl_expenditures.paid_value!=4 and YEAR(xxl_expenditures.created_at) = '.$year.'
                                          GROUP BY spendingtype2, department_id2
                      ) as tbl2

                      where department_id1='.$index.' AND department_id2='.$index.' AND spendingtype1=spendingtype2
                      GROUP BY   spendingtype1;'));

                     $obj = new FreskoTeDhenat();

                     $obj->id = 'buxheti_aktual'.'-'.$index;
                     // $obj->name = 'Këtu është paraqitur buxheti aktual për çdo drejtori i ndarë sipas kategorive të ndryshme gjatë vitit '.$year.'.';
                     $obj->data = $data;

                     $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);
         $this->appendToFile($json_obj, $file);
        }
          //end
          // shpenzimet drejtorite
        $data =  DB::table('expenditures')
                ->join('departments', 'departments.id', '=', 'expenditures.department_id')
                ->select( DB::raw('CONCAT("shpenzimet","-",department_id) as drilldown'),'departments.department as name', DB::raw('SUM(paid_value) as y'))
                ->where('paid','!=',4)->whereYear('expenditures.created_at', '=', $year)
                ->groupBy('expenditures.department_id')
                ->get();

          $obj = new FreskoTeDhenat();
                 $obj->id = 'shpenzimet_drejtorite';
                 // $obj->name = 'Këtu janë paraqitur shpenzimet për secilën drejtori gjatë vitit '.$year.'. Kliko mbi shtylla për ti shikuar kategoritë për drejtorinë përkatëse.';
                 $obj->data = $data;

          $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);

         $this->appendToFile($json_obj, $file);
          //end

        //  shpenzimet drejtorite kategorite
        foreach ($department as  $index => $value) {

          $data =  DB::table('expenditures')
            ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
            ->select(DB::raw('CONCAT("shpenzimet","-",department_id,"-",spendingtype_id) as drilldown'), 'spendingtypes.spendingtype as name', DB::raw('SUM(paid_value) as y'))
            ->where('expenditures.department_id',$index)
            ->where('paid','!=',4)->whereYear('expenditures.created_at', '=', $year)
            ->groupBy('expenditures.spendingtype_id')
            ->get();

          $obj = new FreskoTeDhenat();
                  $obj->id = 'shpenzimet-'.$index;
                  // $obj->name = 'Këtu janë paraqitur shpenzimet për secilën kategori të drejtorisë se klikuar gjatë vitit '.$year.'. Kliko mbi shtylla për ti shikuar nënkategoritë.';
                  $obj->data = $data;

          $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);  

         $this->appendToFile($json_obj, $file);
        }
        // end

        // shpenzimet drejtorite kategorite nenkategorite
        foreach ($department as  $index =>$value) {
          foreach ($spending_types as  $index1 =>$value1) {

          $data = DB::table('expenditures')
                  ->rightjoin('spending_categories', 'spending_categories.id', '=', 'expenditures.spending_category_id')
                  ->select(DB::raw('CONCAT("shpenzimet","-",department_id,"-",spendingtype_id,"-",spending_category_id) as drilldown'), 'spending_categories.spending_category as name', DB::raw('SUM(paid_value) as y'))
                  ->where('expenditures.department_id',$index)
                  ->where('expenditures.spendingtype_id',$index1)
                  ->where('paid','!=',4)->whereYear('expenditures.created_at', '=', $year)
                  ->groupBy('expenditures.spending_category_id')
                  ->get();

          $obj = new FreskoTeDhenat();
                  $obj->id = 'shpenzimet-'.$index.'-'.$index1;
                  // $obj->name = 'Këtu janë paraqitur shpenzimet për secilën nënkategori të kategorisë së klikuar gjatë vitit '.$year.'. Kliko mbi shtylla për ti shikuar furnitorët.';
                  $obj->data = $data;

          $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);

         $this->appendToFile($json_obj, $file);

      }
    }
        // end
            // shpenzimet drejtorite kategorite nenkategorite furnitoret
        foreach ($department as  $index =>$value) {
          foreach ($spending_types as  $index1 =>$value1) {
              foreach ($spending_categories as  $index2 =>$value2) {

                $data = DB::table('expenditures')
                        ->rightjoin('suppliers', 'suppliers.id', '=', 'expenditures.supplier_id')
                        ->select(DB::raw('CONCAT("xx","-",department_id) as drilldown'), 'suppliers.supplier as name', DB::raw('SUM(paid_value) as y'))
                        ->where('expenditures.department_id',$index)
                        ->where('expenditures.spendingtype_id',$index1)
                         ->where('expenditures.spending_category_id',$index2)->whereYear('expenditures.created_at', '=', $year)
                        ->groupBy('expenditures.supplier_id')
                        ->get();

                $obj = new FreskoTeDhenat();
                $obj->id = 'shpenzimet-'.$index.'-'.$index1.'-'.$index2;
                // $obj->name = 'Furnitorët sipas nënkategorive';
                $obj->data = $data;

                $json_obj = json_encode($obj, JSON_NUMERIC_CHECK);
   
              $this->appendToFile($json_obj, $file);
            }
          }
        }
        // end 

        // borxhet drejtorite
        $data =  DB::table('expenditures')
                ->join('departments', 'departments.id', '=', 'expenditures.department_id')
                ->select( DB::raw('CONCAT("borxhet","-",department_id) as drilldown'),'departments.department as name', DB::raw('SUM(value-paid_value) as y'))
                ->groupBy('expenditures.department_id')
                ->where('paid','!=',4)->whereYear('expenditures.created_at', '=', $year)
                ->get();

          $obj = new FreskoTeDhenat();
                 $obj->id = 'borxhet_drejtorite';
                 // $obj->name = 'Këtu janë paraqitur borxhet për secilën drejtori gjatë vitit '.$year.'. Kliko mbi shtylla për ti shikuar kategoritë për drejtorinë përkatëse.';
                 $obj->data = $data;

          $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);

         $this->appendToFile($json_obj, $file);
          //end
          //  shpenzimet drejtorite kategorite
          foreach ($department as  $index =>$value) {

            $data =  DB::table('expenditures')
                    ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                    ->select(DB::raw('CONCAT("borxhet","-",department_id,"-",spendingtype_id) as drilldown'), 'spendingtypes.spendingtype as name', DB::raw('SUM(value-paid_value) as y'))
                    ->where('expenditures.department_id',$index)
                    ->where('paid','!=',4)->whereYear('expenditures.created_at', '=', $year)
                    ->groupBy('expenditures.spendingtype_id')
                    ->get();

            $obj = new FreskoTeDhenat();
                    $obj->id = 'borxhet-'.$index;
                    // $obj->name = 'Këtu janë paraqitur borxhet për secilën kategori të drejtorisë se klikuar gjatë vitit '.$year.'. Kliko mbi shtylla për ti shikuar nënkategoritë.';
                    $obj->data = $data;

            $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);

           $this->appendToFile($json_obj, $file);
          }
          // end

          //borxhet_drejtorite_kategorite_nenkategorite
          foreach ($department as  $index =>$value) {
            foreach ($spending_types as  $index1 =>$value1) {

            $data = DB::table('expenditures')
                    ->rightjoin('spending_categories', 'spending_categories.id', '=', 'expenditures.spending_category_id')
                    ->select(DB::raw('CONCAT("borxhet","-",department_id,"-",spendingtype_id,"-",spending_category_id) as drilldown'), 'spending_categories.spending_category as name', DB::raw('SUM(value-paid_value) as y'))
                    ->where('expenditures.department_id',$index)
                    ->where('expenditures.spendingtype_id',$index1)
                    ->where('paid','!=',4)->whereYear('expenditures.created_at', '=', $year)
                    ->groupBy('expenditures.spending_category_id')
                    ->get();

            $obj = new FreskoTeDhenat();
            $obj->id = 'borxhet-'.$index.'-'.$index1;
            // $obj->name = 'Këtu janë paraqitur borxhet për secilën nënkategori të kategorisë së klikuar gjatë vitit '.$year.'. Kliko mbi shtylla për ti shikuar furnitorët.';
            $obj->data = $data;

            $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);

           $this->appendToFile($json_obj, $file);

        }
      }
      //end of borxhet_drejtorite_kategorite_nenkategorite


      // shpenzimet drejtorite kategorite nenkategorite furnitoret
      foreach ($department as  $index =>$value) {
        foreach ($spending_types as  $index1 =>$value1) {
            foreach ($spending_categories as  $index2 =>$value2) {
              $data = DB::table('expenditures')
                      ->rightjoin('suppliers', 'suppliers.id', '=', 'expenditures.supplier_id')
                      ->select(DB::raw('CONCAT("borxhettt","-") as drilldown'), 'suppliers.supplier as name', DB::raw('SUM(value-paid_value) as y'))
                      ->where('expenditures.department_id',$index)
                      ->where('expenditures.spendingtype_id',$index1)
                       ->where('expenditures.spending_category_id',$index2)->whereYear('expenditures.created_at', '=', $year)
                      ->groupBy('expenditures.supplier_id')
                      ->where('paid','!=',4)
                      ->get();

              $obj = new FreskoTeDhenat();
                      $obj->id = 'borxhet-'.$index.'-'.$index1.'-'.$index2;
                      // $obj->name = 'Këtu janë paraqitur furnitorët të cilëve ju ka borxh drejtoria përkatëse.';
                      $obj->data = $data;

              $json_obj = json_encode ($obj, JSON_NUMERIC_CHECK);

             $this->appendToFile($json_obj, $file);
          }
        }
      }

      // end of shpenzimet drejtorite kategorite nenkategorite furnitoret

      fclose($file);
      //mesazhi ne fund
      $this->info('Te dhenat u freskuan me sukses!');


    }

    public function appendToFile($json, $file){
     
      fwrite($file, $json.',');
      // fclose($file);

       // File::append(storage_path('charts/'.$year.'/all.js'), $json.',');
    }



}
