<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('onPatient') -> unsigned() -> default(0);
            $table->foreign('onPatient')
                  ->references('id')->on('patients')
                  ->onDelete('cascade');
            $table->integer('from_user') -> unsigned() -> default(0);
            $table->foreign('from_user')
                  ->references('id')->on('users');
            $table->string('prescription');
            $table->text('description');
            $table->date('from_date');
            $table->date('to_date');
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
        Schema::drop('medications');
    }
}
