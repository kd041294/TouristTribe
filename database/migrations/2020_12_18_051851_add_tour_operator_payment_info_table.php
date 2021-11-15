<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTourOperatorPaymentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_operators', function (Blueprint $table) {
            $table->text("bank_account_name")->nullable();
            $table->text("bank_account_no")->nullable();
            $table->text("bank_ifsc_code")->nullable();
            $table->text("bank_mobile_number")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_operators', function (Blueprint $table) {
            //
        });
    }
}
