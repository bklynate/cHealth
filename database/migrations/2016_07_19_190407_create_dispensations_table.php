<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispensationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispensations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('drugId'); 
            $table->string('medId');
            $table->string('onPatient');
            $table->string('from_user');
            $table->string('prescription');
            $table->text('description')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->integer('quantity_dispensed')->nullable();
            $table->integer('quantity_left')->nullable();
            $table->integer('status')->default(0);
            $table->string('dispensedBy')->nullable();
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
        Schema::drop('dispensations');
    }
}
