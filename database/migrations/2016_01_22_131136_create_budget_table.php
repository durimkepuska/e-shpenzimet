<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('budget', function (Blueprint $table) {

          $table->increments('id');

          $table->integer('department_id')->unsigned()->nullable();

          $table->integer('spendingtype_id')->unsigned()->nullable();

          $table->integer('payment_source_id')->unsigned()->nullable();

          $table->decimal('value', 11, 3);

          $table->foreign('payment_source_id')->references('id')->on('payment_sources')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->foreign('department_id')->references('id')->on('departments')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->foreign('spendingtype_id')->references('id')->on('spendingtypes')
              ->onUpdate('restrict')
              ->onDelete('set null');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('budget');
    }
}
