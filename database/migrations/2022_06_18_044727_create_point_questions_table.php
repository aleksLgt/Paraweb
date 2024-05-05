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
        Schema::create('point_questions', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unsignedInteger('min_score')->default(0);
            $table->string('min_score_description')->default(0);
            $table->unsignedInteger('max_score');
            $table->unsignedBigInteger('survey_id');
            $table->foreign('survey_id')->references('id')->on('surveys')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('max_score_description')->default(0);
            $table->boolean('is_answer_required')->default(false);
            $table->boolean('is_visible')->default(true);
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
        Schema::dropIfExists('point_questions');
    }
};
