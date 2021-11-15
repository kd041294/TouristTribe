<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                   ->constrained('users')
                   ->onUpdate('cascade')
                   ->onDelete('cascade');
            $table->foreignId('answer_id')
                  ->constrained('answers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->text('description');
            $table->string('img')->nullable();
            $table->integer('vote')->default(0);
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
        Schema::dropIfExists('answer_replies');
    }
}
