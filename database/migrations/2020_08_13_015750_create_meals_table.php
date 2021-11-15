<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_operator_id')
                  ->constrained('tour_operators')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('location_id')
                  ->constrained('locations')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('location_name')->nullable(); 
            $table->string('breakfast_details')->nullable();
            $table->string('lunch_details')->nullable();
            $table->string('evening_tea_details')->nullable();
            $table->string('dinner_details')->nullable();
            $table->integer('per_head_cost')->nullable();
            $table->integer('use')->default('0');
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
        Schema::dropIfExists('meals');
    }
}
