<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                   ->constrained('users')
                   ->onUpdate('cascade')
                   ->onDelete('cascade');
            $table->text('question');
            $table->string('img')->nullable();
            $table->string('link')->nullable();
            $table->string('topic1')->nullable();
            $table->string('topic2')->nullable();
            $table->string('topic3')->nullable();
            $table->string('topic4')->nullable();
            $table->string('topic5')->nullable();
            $table->text('all_tags')->nullable();
            $table->string('location')->nullable();
            $table->text('question_url');
            $table->bigInteger('vote')->default(0);
            $table->bigInteger('view')->default(0);
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
        Schema::dropIfExists('questions');
    }
}
