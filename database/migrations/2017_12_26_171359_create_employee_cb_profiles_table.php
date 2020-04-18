<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeCbProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_cb_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
            $table->string('employee_id');
            $table->string('employee_pic')->nullable();
            $table->string('designation')->nullable();
            $table->string('joined_as')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('status')->nullable();
            $table->string('salary')->nullable();
            $table->string('stay_bonus')->nullable();
            $table->string('appraisal_date')->nullable();
            $table->string('epf')->nullable();
            $table->string('esi')->nullable();
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
        Schema::dropIfExists('employee_cb_profiles');
    }
}
