<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_question_user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('free_question_id');
            $table->foreign('free_question_id')->references('id')->on('free_questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('answer');
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
        Schema::dropIfExists('free_question_user_answers');
    }
};
