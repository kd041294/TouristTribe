<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_operator_id')
                  ->constrained('tour_operators')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('total_member_size')->nullable();
            $table->string('min_family_member')->nullable();
            $table->string('name_of_city')->nullable();
            $table->text('location_images')->nullable();
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
        Schema::dropIfExists('locations');
    }
}
