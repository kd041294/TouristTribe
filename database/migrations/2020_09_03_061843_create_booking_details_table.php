<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')
                  ->constrained('trips')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade')->nullable();
            $table->string('person_name')->nullable();
            $table->string('person_email')->nullable();
            $table->string('person_mobile')->nullable();
            $table->integer('no_of_person')->nullable();
            $table->integer('no_of_room')->nullable();
            $table->integer('room_type')->nullable();
            $table->date('bookingDate')->nullable();
            $table->enum('booking_payment_mode',['online','offline'])->nullable();
            $table->enum('booking_for',['general','family'])->default('family');
            $table->string('booking_payu_money_id')->nullable();
            $table->integer('total_booking_amount')->nullable();
            $table->integer('booking_amount_paid')->nullable();
            $table->integer('booking_amount_not_paid')->nullable();
            $table->enum('booking_amount_full_paid',['yes','no'])->nullable();
            $table->text('extraDetails')->nullable();
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
        Schema::dropIfExists('booking_details');
    }
}
