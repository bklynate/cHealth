<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitals', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('onPatient') -> unsigned() -> default(0);
            $table->foreign('onPatient')
                  ->references('id')->on('patients')
                  ->onDelete('cascade');
            $table->integer('from_user') -> unsigned() -> default(0);
            $table->foreign('from_user')
                  ->references('id')->on('users');
            $table->double('weight');
            $table->double('height');
            $table->double('bmi');
            $table->double('bloodPressure');
            $table->double('pulse');
            $table->double('temperature');
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
        Schema::drop('vitals');
    }
}
