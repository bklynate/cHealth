<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTherapiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('therapies', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('onPatient') -> unsigned() -> default(0);
            $table->foreign('onPatient')
                  ->references('id')->on('patients')
                  ->onDelete('cascade');
            $table->string('therapy_name');
            $table->date('date_administered');
            $table->integer('from_user') -> unsigned() -> default(0);
            $table->foreign('from_user')
                  ->references('id')->on('users');
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
        Schema::drop('therapies');
    }
}
