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
        Schema::create('choice_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('choice_question_id');
            $table->foreign('choice_question_id')->references('id')->on('choice_questions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('text');
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
        Schema::dropIfExists('choice_question_answers');
    }
};
