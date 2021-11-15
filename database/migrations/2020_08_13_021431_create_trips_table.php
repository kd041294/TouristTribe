<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_operator_id')
                  ->constrained('tour_operators')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('location_id')
                  ->constrained('locations')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('trip_name')->nullable();
            $table->string('location_name')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->integer('no_of_nights')->nullable();
            $table->text('hotels')->nullable();
            $table->text('midtrips')->nullable();
            $table->text('transfers')->nullable();
            $table->string('meal')->nullable();
            $table->enum('allGender', ['0', '1'])->default('0');
            $table->enum('onlyMens', ['0', '1'])->default('0');
            $table->enum('onlyWomens', ['0', '1'])->default('0');
            $table->enum('allCast', ['0', '1'])->default('0');
            $table->enum('buddhismCast', ['0', '1'])->default('0');
            $table->enum('hinduCast', ['0', '1'])->default('0');
            $table->enum('sikhismCast', ['0', '1'])->default('0');
            $table->enum('islamCast', ['0', '1'])->default('0');
            $table->enum('christianCast', ['0', '1'])->default('0');
            $table->text('pickup_details')->nullable();
            $table->text('drop_details')->nullable();
            $table->text('other_details')->nullable();
            $table->integer('use')->default('0');
            $table->enum('vacation',['yes','no'])->default('no');
            $table->date('starting_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->enum('payment_revision',['yes','no'])->default('no');
            $table->date('payment_revision_date_start')->nullable();
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
        Schema::dropIfExists('trips');
    }
}
