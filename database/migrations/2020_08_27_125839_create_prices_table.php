<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')
                  ->constrained('trips')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('single_bed_price')->default('0');
            $table->integer('double_bed_price')->default('0');
            $table->integer('triple_bed_price')->default('0');
            $table->integer('meal_price')->default('0');
            $table->integer('vehical_cost')->default('0');
            $table->integer('vehical_limit')->default('0');
            $table->integer('location_limit')->default('0');
            $table->integer('location_min_family_limit')->default('0');
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
        Schema::dropIfExists('prices');
    }
}
