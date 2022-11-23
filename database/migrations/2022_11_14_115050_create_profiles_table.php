<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('jobTitle')->nullable();
            $table->string('company')->nullable();
            $table->string('employeeNumber')->nullable();
            $table->string('gender')->nullable();
            $table->string('departmentNumber')->nullable();
            $table->string('department')->nullable();
            $table->string('phoneMobile')->nullable();
            $table->string('phoneWork')->nullable();
            $table->string('email')->nullable();
            $table->string('workgroup')->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
