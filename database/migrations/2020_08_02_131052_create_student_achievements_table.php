<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_achievements', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('preference_category_id');
            $table->tinyInteger('student_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('approval_status');
            $table->datetime('approved_on');
            $table->Integer('approved_by');
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_deleted');
            $table->Integer('created_by');
            $table->Integer('updated_by');
            $table->Integer('deleted_by');
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('student_achievements');
    }
}
