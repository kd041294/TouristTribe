<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_operators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('mobile_number')->unique();
            $table->string('email')->unique();
            $table->string('comp_name')->nullable();
            $table->string('adhar_number')->nullable();
            $table->string('gst')->nullable();
            $table->integer('otp')->nullable();
            $table->string('pic')->nullable();
            $table->string('password');
            $table->enum('status',['1','0']);
            $table->rememberToken();
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
        Schema::dropIfExists('tour_operators');
    }
}
