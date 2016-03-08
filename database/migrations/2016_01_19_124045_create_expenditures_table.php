<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('expenditures', function ($table) {

          $table->increments('id');

          $table->string('description');

          $table->string('invoice_number');

          $table->integer('spendingtype_id')->unsigned()->nullable();

          $table->integer('spending_category_id')->unsigned()->nullable();

          $table->decimal('value', 11, 2);

          $table->integer('supplier_id')->unsigned()->nullable();

          $table->integer('department_id')->unsigned()->nullable();

          $table->integer('user_id')->unsigned()->nullable();

          $table->integer('payment_source_id')->unsigned()->nullable();

          $table->date('payment_date');

          $table->date('expenditure_date');

          $table->boolean('paid');

          $table->decimal('paid_value', 11, 2);

          $table->boolean('hidde');

          $table->date('dept_paid_date');


          $table->foreign('payment_source_id')->references('id')->on('payment_sources')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->foreign('department_id')->references('id')->on('departments')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->foreign('spendingtype_id')->references('id')->on('spendingtypes')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->foreign('supplier_id')->references('id')->on('suppliers')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->foreign('user_id')->references('id')->on('users')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->foreign('spending_category_id')->references('id')->on('spending_categories')
              ->onUpdate('restrict')
              ->onDelete('set null');

          $table->timestamps();

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expenditures');
    }
}
