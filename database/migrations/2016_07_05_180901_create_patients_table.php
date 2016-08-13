<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification');
            $table->string('medId')->unique();
            $table->string('firstName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('lastName')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('estimatedAge')->nullable();
            $table->string('gender');
            $table->string('patientPhone')->nullable();
            $table->string('kinPhone')->nullable();
            $table->string('email')->nullable();
            $table->string('residence')->nullable();
            $table->string('county')->nullable();
            $table->string('countryOrigin')->nullable();
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
        Schema::drop('patients');
    }
}
