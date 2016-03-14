<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $departments = [
              ['id' => 1,'department'=>'Punë të Përgjithshme Administrative'],
              ['id' => 2,'department'=>'Buxhet dhe Financa'],
              ['id' => 3,'department'=>'Arsim'],
              ['id' => 4,'department'=>'Shëndetësi dhe Mirëqenie Sociale'],
              ['id' => 5,'department'=>'Shërbime Publike'],
              ['id' => 6,'department'=>'Punë Inspektuese'],
              ['id' => 7,'department'=>'Bujqësi, Pylltari dhe Zhvillim Rural'],
              ['id' => 8,'department'=>'Mbrojtje dhe Shpëtim'],
              ['id' => 9,'department'=>'Urbanizëm dhe Mbrojtje të Mjedisit'],
              ['id' => 10,'department'=>'Gjeodezi, Kadastër dhe Pronë'],
              ['id' => 11,'department'=>'Kulturë, Rini dhe Sport'],
              ['id' => 12,'department'=>'Zhvillim Ekonomik'],
        ];
        DB::table('departments')->insert($departments);

       $expenditurestatus = [
             ['id' => 1,'status'=>'Paguar'],
             ['id' => 2,'status'=>'Borxh'],
             ['id' => 3,'status'=>'Pjesërisht e paguar'],

       ];
       DB::table('expenditurestatus')->insert($expenditurestatus);

       $payment_sources = [
             ['id' => 1,'payment_source'=>'Buxheti i Kosovës'],
             ['id' => 2,'payment_source'=>'Të Hyra Vetanake'],
             ['id' => 3,'payment_source'=>'Donatorë'],

       ];
       DB::table('payment_sources')->insert($payment_sources);


       DB::table('spending_categories')->insert([
          'spending_category' => 'Material Zyrtarë',
       ]);


       $spendingtypes = [
             ['id' => 1,'spendingtype'=>'Mallra dhe shërbime'],
             ['id' => 2,'spendingtype'=>'Kapitale'],
             ['id' => 3,'spendingtype'=>'Komunali'],
       ];
       DB::table('spendingtypes')->insert($spendingtypes);

       $user_roles = [
              ['id' => 1,'role'=>'Admin'],
              ['id' => 2,'role'=>'Drejtorë'],
              ['id' => 3,'role'=>'Zyrtarë'],
              ['id' => 4,'role'=>'Ekzekutues'],
        ];
        DB::table('user_roles')->insert($user_roles);

        DB::table('users')->insert([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'department_id' => 1,
          'role_id' => 1,
          'password' => bcrypt('durimi328'),
        ]);

        $file_types = [
            ['id' => 1,'type'=>'xls'],
            ['id' => 2,'type'=>'xlsx'],
            ['id' => 3,'type'=>'pdf'],
            ['id' => 4,'type'=>'csv'],
        ];
        DB::table('filetype')->insert($file_types);

        Model::reguard();
    }
}
