<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidtripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midtrips', function (Blueprint $table) {
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
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('images')->nullable();
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
        Schema::dropIfExists('midtrips');
    }
}
