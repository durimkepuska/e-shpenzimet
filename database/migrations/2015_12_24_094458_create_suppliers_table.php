<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function ($table) {



            $table->increments('id');

            $table->string('supplier');

            $table->string('address');

            $table->string('telephone');

            $table->string('fiscal_number');

            $table->string('city');

            $table->string('country');

            $table->string('contact_person');

            $table->decimal('lat', 11, 6);

            $table->decimal('lon', 11, 6);



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suppliers');
    }
}
