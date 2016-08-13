<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('onPatient') -> unsigned() -> default(0);
            $table->foreign('onPatient')
                  ->references('id')->on('patients')
                  ->onDelete('cascade');
            $table->string('procedure_name');
            $table->string('procedure_type');
            $table->string('procedure_notes');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('duration');
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
        Schema::drop('procedures');
    }
}
