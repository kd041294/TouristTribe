<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
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
            $table->smallInteger('rating')->nullable();
            $table->enum('type',['AC','NAC'])->nullable();
            $table->string('hotel_name')->nullable();
            $table->integer('single_bed_type_cost')->nullable();
            $table->integer('double_bed_type_cost')->nullable();
            $table->integer('triple_bed_type_cost')->nullable(); 
            $table->text('images')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
