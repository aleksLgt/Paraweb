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
        Schema::create('point_question_user_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('point_question_id');
            $table->foreign('point_question_id')->references('id')->on('point_questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('answer');
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
        Schema::dropIfExists('point_question_user_answers');
    }
};
