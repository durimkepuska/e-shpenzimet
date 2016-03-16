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
      $department = Department::lists('department', 'id');
      $spending_types = Spendingtype::lists('spendingtype', 'id');
      $spending_categories = SpendingCategory::lists('spending_category', 'id');

      //shpenzimet totale
      $shpenzimet_total =  DB::table('expenditures')
              ->select(DB::raw('SUM(paid_value) as total'))->where('paid','!=',4)
              ->get();
      File::put(storage_path('charts/2016/totals/shpenzimet_total.js'), $shpenzimet_total[0]->total);
      //end

      //borxhet totale
      $borxhet_total =  DB::table('expenditures')
              ->select(DB::raw('SUM(value-paid_value) as total'))->where('paid','!=',4)
              ->get();
      File::put(storage_path('charts/2016/totals/borxhet_total.js'), $borxhet_total[0]->total);
      //end

      //buxheti total
      $buxheti_total =  DB::table('budget')
              ->select(DB::raw('SUM(value) as total'))
              ->get();
      File::put(storage_path('charts/2016/totals/buxheti_total.js'), $buxheti_total[0]->total);
      //end

      //buxheti aktual
      $buxheti_aktual =  $buxheti_total[0]->total - $shpenzimet_total[0]->total;
      File::put(storage_path('charts/2016/totals/buxheti_aktual.js'), $buxheti_aktual);
      //end

      // buxheti fillestare drejtorite
      $buxheti_fillestare_drejtorite =  DB::table('budget')
              ->join('departments', 'departments.id', '=', 'budget.department_id')
              ->select( DB::raw('CONCAT("buxheti_fillestare","-",department_id) as drilldown'),'departments.department as name', DB::raw('SUM(value) as y'))
              ->groupBy('budget.department_id')
              ->get();

        $buxheti_fillestare_object = new FreskoTeDhenat();

               $buxheti_fillestare_object->id = 'buxheti_fillestare_drejtorite';
               $buxheti_fillestare_object->name = 'Këtu është paraqitur buxheti fillestar për çdo drejtori gjatë vitit 2016. Kliko mbi shtylla për më shumë informata';
               $buxheti_fillestare_object->data = $buxheti_fillestare_drejtorite;

        $buxheti_fillestare_json = json_encode ($buxheti_fillestare_object, JSON_NUMERIC_CHECK);

        File::put(storage_path('charts/2016/all.js'), $buxheti_fillestare_json.',');
        //end

        //  buxhetin fillestare drejtorite kategorite
        foreach ($department as  $index =>$value) {
          $buxheti_fillestare_drejtorite_kategorite =  DB::table('budget')
                  ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'budget.spendingtype_id')
                  ->select(DB::raw('CONCAT("buxheti_fillestare","-",department_id,"-",spendingtype_id) as drilldown'), 'spendingtypes.spendingtype as name', DB::raw('SUM(value) as y'))
                  ->where('budget.department_id',$index)
                  ->groupBy('budget.spendingtype_id')
                  ->get();

          $buxheti_fillestare_drejtorite_kategorite_object = new FreskoTeDhenat();
                  $buxheti_fillestare_drejtorite_kategorite_object->id = 'buxheti_fillestare-'.$index;
                  $buxheti_fillestare_drejtorite_kategorite_object->name = 'Këtu është paraqitur buxheti fillestar për çdo drejtori i ndarë ne kategori të ndryshme gjatë vitit 2016.';
                  $buxheti_fillestare_drejtorite_kategorite_object->data = $buxheti_fillestare_drejtorite_kategorite;

          $buxheti_fillestare_drejtorite_kategorite_json = json_encode ($buxheti_fillestare_drejtorite_kategorite_object, JSON_NUMERIC_CHECK);

          File::append(storage_path('charts/2016/all.js'), $buxheti_fillestare_drejtorite_kategorite_json.',');

        }
        // end

          //buxheti aktual drejtorite
        $buxheti_aktual_drejtorite =  DB::select(DB::raw('SELECT
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
                                          GROUP BY department_id
                  												ORDER BY department_id
                      ) as tbl2

                      where department_id1=department_id2
                      GROUP BY  department_id1, department_id2;'));

                     $buxheti_aktual_drejtorite_object = new FreskoTeDhenat();

                     $buxheti_aktual_drejtorite_object->id = 'buxheti_aktual_drejtorite';
                     $buxheti_aktual_drejtorite_object->name = 'Këtu është paraqitur buxheti aktual për çdo drejtori gjatë vitit 2016. Kliko mbi shtylla për më shumë informata';
                     $buxheti_aktual_drejtorite_object->data = $buxheti_aktual_drejtorite;

                     $buxheti_aktual_drejtorite_json = json_encode ($buxheti_aktual_drejtorite_object, JSON_NUMERIC_CHECK);
          File::append(storage_path('charts/2016/all.js'), $buxheti_aktual_drejtorite_json.',');
          //end

          //buxheti aktual drejtorite kategorite
          foreach ($department as  $index =>$value) {

              $buxheti_aktual_drejtorite_kategorite =  DB::select(DB::raw('SELECT
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
                                          where xxl_expenditures.paid_value!=4
                                          GROUP BY spendingtype2, department_id2
                      ) as tbl2

                      where department_id1='.$index.' AND department_id2='.$index.' AND spendingtype1=spendingtype2
                      GROUP BY   spendingtype1;'));

                     $buxheti_aktual_drejtorite_kategorite_object = new FreskoTeDhenat();

                     $buxheti_aktual_drejtorite_kategorite_object->id = 'buxheti_aktual'.'-'.$index;
                     $buxheti_aktual_drejtorite_kategorite_object->name = 'Këtu është paraqitur buxheti aktual për çdo drejtori i ndarë sipas kategorive të ndryshme gjatë vitit 2016.';
                     $buxheti_aktual_drejtorite_kategorite_object->data = $buxheti_aktual_drejtorite_kategorite;

                     $buxheti_aktual_drejtorite_kategorite_json = json_encode ($buxheti_aktual_drejtorite_kategorite_object, JSON_NUMERIC_CHECK);
          File::append(storage_path('charts/2016/all.js'), $buxheti_aktual_drejtorite_kategorite_json.',');
        }
          //end

          // shpenzimet drejtorite
        $shpenzimet_drejtorite =  DB::table('expenditures')
                ->join('departments', 'departments.id', '=', 'expenditures.department_id')
                ->select( DB::raw('CONCAT("shpenzimet","-",department_id) as drilldown'),'departments.department as name', DB::raw('SUM(paid_value) as y'))
                ->where('paid','!=',4)
                ->groupBy('expenditures.department_id')
                ->get();

          $shpenzimet_drejtorite_object = new FreskoTeDhenat();
                 $shpenzimet_drejtorite_object->id = 'shpenzimet_drejtorite';
                 $shpenzimet_drejtorite_object->name = 'Këtu janë paraqitur shpenzimet për secilën drejtori gjatë vitit 2016. Kliko mbi shtylla për ti shikuar kategoritë për drejtorinë përkatëse.';
                 $shpenzimet_drejtorite_object->data = $shpenzimet_drejtorite;

          $shpenzimet_drejtorite_json = json_encode ($shpenzimet_drejtorite_object, JSON_NUMERIC_CHECK);

          File::append(storage_path('charts/2016/all.js'), $shpenzimet_drejtorite_json.',');
          //end


        //  shpenzimet drejtorite kategorite
        foreach ($department as  $index =>$value) {

          $shpenzimet_drejtorite_kategorite =  DB::table('expenditures')
                  ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                  ->select(DB::raw('CONCAT("shpenzimet","-",department_id,"-",spendingtype_id) as drilldown'), 'spendingtypes.spendingtype as name', DB::raw('SUM(paid_value) as y'))
                  ->where('expenditures.department_id',$index)->where('paid','!=',4)
                  ->groupBy('expenditures.spendingtype_id')
                  ->get();

          $shpenzimet_drejtorite_kategorite_object = new FreskoTeDhenat();
                  $shpenzimet_drejtorite_kategorite_object->id = 'shpenzimet-'.$index;
                  $shpenzimet_drejtorite_kategorite_object->name = 'Këtu janë paraqitur shpenzimet për secilën kategori të drejtorisë se klikuar gjatë vitit 2016. Kliko mbi shtylla për ti shikuar nënkategoritë.';
                  $shpenzimet_drejtorite_kategorite_object->data = $shpenzimet_drejtorite_kategorite;

          $shpenzimet_drejtorite_kategorite_json = json_encode ($shpenzimet_drejtorite_kategorite_object, JSON_NUMERIC_CHECK);

          File::append(storage_path('charts/2016/all.js'), $shpenzimet_drejtorite_kategorite_json.',');
        }
        // end


        // shpenzimet drejtorite kategorite nenkategorite
        foreach ($department as  $index =>$value) {
          foreach ($spending_types as  $index1 =>$value1) {

          $shpenzimet_drejtorite_kategorite_nenkategorite = DB::table('expenditures')
                  ->rightjoin('spending_categories', 'spending_categories.id', '=', 'expenditures.spending_category_id')
                  ->select(DB::raw('CONCAT("shpenzimet","-",department_id,"-",spendingtype_id,"-",spending_category_id) as drilldown'), 'spending_categories.spending_category as name', DB::raw('SUM(paid_value) as y'))
                  ->where('expenditures.department_id',$index)
                  ->where('expenditures.spendingtype_id',$index1)
                  ->where('paid','!=',4)
                  ->groupBy('expenditures.spending_category_id')
                  ->get();

          $shpenzimet_drejtorite_kategorite_nenkategorite_object = new FreskoTeDhenat();
                  $shpenzimet_drejtorite_kategorite_nenkategorite_object->id = 'shpenzimet-'.$index.'-'.$index1;
                  $shpenzimet_drejtorite_kategorite_nenkategorite_object->name = 'Këtu janë paraqitur shpenzimet për secilën nënkategori të kategorisë së klikuar gjatë vitit 2016. Kliko mbi shtylla për ti shikuar furnitorët.';
                  $shpenzimet_drejtorite_kategorite_nenkategorite_object->data = $shpenzimet_drejtorite_kategorite_nenkategorite;

          $shpenzimet_drejtorite_kategorite_nenkategorite_json = json_encode ($shpenzimet_drejtorite_kategorite_nenkategorite_object, JSON_NUMERIC_CHECK);

          File::append(storage_path('charts/2016/all.js'), $shpenzimet_drejtorite_kategorite_nenkategorite_json.',');

      }
    }
        // end

        // shpenzimet drejtorite kategorite nenkategorite furnitoret
        foreach ($department as  $index =>$value) {
          foreach ($spending_types as  $index1 =>$value1) {
              foreach ($spending_categories as  $index2 =>$value2) {


          $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret = DB::table('expenditures')
                  ->rightjoin('suppliers', 'suppliers.id', '=', 'expenditures.supplier_id')
                  ->select(DB::raw('CONCAT("xx","-",department_id) as drilldown'), 'suppliers.supplier as name', DB::raw('SUM(paid_value) as y'))
                  ->where('expenditures.department_id',$index)
                  ->where('expenditures.spendingtype_id',$index1)
                   ->where('expenditures.spending_category_id',$index2)
                  ->groupBy('expenditures.supplier_id')
                  ->get();

          $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret_object = new FreskoTeDhenat();
                  $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret_object->id = 'shpenzimet-'.$index.'-'.$index1.'-'.$index2;
                  $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret_object->name = 'Furnitorët sipas nënkategorive';
                  $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret_object->data = $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret;

          $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret_json = json_encode ($shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret_object, JSON_NUMERIC_CHECK);

          File::append(storage_path('charts/2016/all.js'), $shpenzimet_drejtorite_kategorite_nenkategorite_furnitoret_json.',');

            }
         }
       }
        // end

        // borxhet drejtorite
        $borxhet_drejtorite =  DB::table('expenditures')
                ->join('departments', 'departments.id', '=', 'expenditures.department_id')
                ->select( DB::raw('CONCAT("borxhet","-",department_id) as drilldown'),'departments.department as name', DB::raw('SUM(value-paid_value) as y'))
                ->groupBy('expenditures.department_id')
                ->where('paid','!=',4)
                ->get();

          $borxhet_drejtorite_object = new FreskoTeDhenat();
                 $borxhet_drejtorite_object->id = 'borxhet_drejtorite';
                 $borxhet_drejtorite_object->name = 'Këtu janë paraqitur borxhet për secilën drejtori gjatë vitit 2016. Kliko mbi shtylla për ti shikuar kategoritë për drejtorinë përkatëse.';
                 $borxhet_drejtorite_object->data = $borxhet_drejtorite;

          $borxhet_drejtorite_json = json_encode ($borxhet_drejtorite_object, JSON_NUMERIC_CHECK);

          File::append(storage_path('charts/2016/all.js'), $borxhet_drejtorite_json.',');
          //end

          //  shpenzimet drejtorite kategorite
          foreach ($department as  $index =>$value) {

            $borxhet_drejtorite_kategorite =  DB::table('expenditures')
                    ->rightjoin('spendingtypes', 'spendingtypes.id', '=', 'expenditures.spendingtype_id')
                    ->select(DB::raw('CONCAT("borxhet","-",department_id,"-",spendingtype_id) as drilldown'), 'spendingtypes.spendingtype as name', DB::raw('SUM(value-paid_value) as y'))
                    ->where('expenditures.department_id',$index)
                    ->where('paid','!=',4)
                    ->groupBy('expenditures.spendingtype_id')
                    ->get();

            $borxhet_drejtorite_kategorite_object = new FreskoTeDhenat();
                    $borxhet_drejtorite_kategorite_object->id = 'borxhet-'.$index;
                    $borxhet_drejtorite_kategorite_object->name = 'Këtu janë paraqitur borxhet për secilën kategori të drejtorisë se klikuar gjatë vitit 2016. Kliko mbi shtylla për ti shikuar nënkategoritë.';
                    $borxhet_drejtorite_kategorite_object->data = $borxhet_drejtorite_kategorite;

            $borxhet_drejtorite_kategorite_json = json_encode ($borxhet_drejtorite_kategorite_object, JSON_NUMERIC_CHECK);

            File::append(storage_path('charts/2016/all.js'), $borxhet_drejtorite_kategorite_json.',');
          }
          // end

          foreach ($department as  $index =>$value) {
            foreach ($spending_types as  $index1 =>$value1) {

            $borxhet_drejtorite_kategorite_nenkategorite = DB::table('expenditures')
                    ->rightjoin('spending_categories', 'spending_categories.id', '=', 'expenditures.spending_category_id')
                    ->select(DB::raw('CONCAT("borxhet","-",department_id,"-",spendingtype_id,"-",spending_category_id) as drilldown'), 'spending_categories.spending_category as name', DB::raw('SUM(value-paid_value) as y'))
                    ->where('expenditures.department_id',$index)
                    ->where('expenditures.spendingtype_id',$index1)
                    ->where('paid','!=',4)
                    ->groupBy('expenditures.spending_category_id')
                    ->get();

            $borxhet_drejtorite_kategorite_nenkategorite_object = new FreskoTeDhenat();
                    $borxhet_drejtorite_kategorite_nenkategorite_object->id = 'borxhet-'.$index.'-'.$index1;
                    $borxhet_drejtorite_kategorite_nenkategorite_object->name = 'Këtu janë paraqitur shpenzimet për secilën nënkategori të kategorisë së klikuar gjatë vitit 2016. Kliko mbi shtylla për ti shikuar furnitorët.';
                    $borxhet_drejtorite_kategorite_nenkategorite_object->data = $borxhet_drejtorite_kategorite_nenkategorite;

            $borxhet_drejtorite_kategorite_nenkategorite_json = json_encode ($borxhet_drejtorite_kategorite_nenkategorite_object, JSON_NUMERIC_CHECK);

            File::append(storage_path('charts/2016/all.js'), $borxhet_drejtorite_kategorite_nenkategorite_json.',');

        }
      }

      // shpenzimet drejtorite kategorite nenkategorite furnitoret
      foreach ($department as  $index =>$value) {
        foreach ($spending_types as  $index1 =>$value1) {
            foreach ($spending_categories as  $index2 =>$value2) {


        $borxhet_drejtorite_kategorite_nenkategorite_furnitoret = DB::table('expenditures')
                ->rightjoin('suppliers', 'suppliers.id', '=', 'expenditures.supplier_id')
                ->select(DB::raw('CONCAT("borxhettt","-") as drilldown'), 'suppliers.supplier as name', DB::raw('SUM(value-paid_value) as y'))
                ->where('expenditures.department_id',$index)
                ->where('expenditures.spendingtype_id',$index1)
                 ->where('expenditures.spending_category_id',$index2)
                ->groupBy('expenditures.supplier_id')
                ->where('paid','!=',4)
                ->get();

        $borxhet_drejtorite_kategorite_nenkategorite_furnitoret_object = new FreskoTeDhenat();
                $borxhet_drejtorite_kategorite_nenkategorite_furnitoret_object->id = 'borxhet-'.$index.'-'.$index1.'-'.$index2;
                $borxhet_drejtorite_kategorite_nenkategorite_furnitoret_object->name = 'Këtu janë paraqitur furnitorët të cilëve ju ka borxh drejtoria përkatëse.';
                $borxhet_drejtorite_kategorite_nenkategorite_furnitoret_object->data = $borxhet_drejtorite_kategorite_nenkategorite_furnitoret;

        $borxhet_drejtorite_kategorite_nenkategorite_furnitoret_json = json_encode ($borxhet_drejtorite_kategorite_nenkategorite_furnitoret_object, JSON_NUMERIC_CHECK);

        File::append(storage_path('charts/2016/all.js'), $borxhet_drejtorite_kategorite_nenkategorite_furnitoret_json.',');

          }
       }
     }

        $this->info('Te dhenat u freskuan me sukses!');
    }




}
