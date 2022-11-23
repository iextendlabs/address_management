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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('profile_id')->nullable();
            $table->string('prefix')->nullable();
            $table->string('number')->nullable();
            $table->string('suburb')->nullable();
            $table->string('street')->nullable();
            $table->string('city_town')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode_zipcode')->nullable();
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
        Schema::dropIfExists('addresses');
    }
};
