<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')
                  ->constrained('coupons')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignId('tour_operator_id')
                  ->constrained('tour_operators')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->integer('paymentPaid');
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
        Schema::dropIfExists('coupon_users');
    }
}
