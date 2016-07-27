<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refills', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('drugId');
            $table->string('drugName');
            $table->string('formulation');
            $table->string('description');
            $table->integer('quantity');
            $table->date('expiryDate')->nullable();
            $table->string('createdBy');
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
        Schema::drop('refills');
    }
}
