<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offline_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_operator_id')
                  ->constrained('tour_operators')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('trip_id')
                  ->constrained('trips')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('customer_name')->nullable();
            $table->integer('mobile')->nullable();
            $table->integer('room')->nullable();
            $table->integer('bed')->nullable();
            $table->integer('total_customer')->nullable();
            $table->date('booking_date')->nullable();
            $table->enum('status',['0','1'])->nullable();
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
        Schema::dropIfExists('offline_bookings');
    }
}
