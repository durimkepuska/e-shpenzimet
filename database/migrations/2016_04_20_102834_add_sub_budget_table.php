<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('sub_budget', function (Blueprint $table) {

           $table->increments('id');

           $table->integer('department_id')->unsigned()->nullable();

           $table->string('sub_budget');

        });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('sub_budget');
     }
}
