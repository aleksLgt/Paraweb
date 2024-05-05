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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('survey_category_id');
            $table->foreign('survey_category_id')->references('id')->on('survey_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('survey_admin_id');
            $table->foreign('survey_admin_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('year_interval_id');
            $table->foreign('year_interval_id')->references('id')->on('year_intervals')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('planned_date_start');
            $table->date('planned_date_end');
            $table->date('real_date_start')->nullable();
            $table->date('real_date_end')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('surveys');
    }
};
