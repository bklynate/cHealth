<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('service');
            $table->double('cost');
            $table->integer('status');
            $table->integer('createdBy')->unsigned()->default(0);
            $table->foreign('createdBy')
                  ->references('id')->on('users');
            $table->integer('updatedBy')->unsigned()->default(0);
            $table->foreign('updatedBy')
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
        Schema::drop('services');
    }
}
