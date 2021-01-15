<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherOnDemandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_on_demand', function (Blueprint $table) {
            $table->id();
            $table->Integer('student_id');
            $table->Integer('teacher_id');
            $table->date('requested_date');
            $table->time('requested_time');
            $table->text('question');
            $table->date('approved_start_date');
            $table->time('approved_start_time');
            $table->string('approval_status');
            $table->datetime('approved_on')->nullable();
            $table->Integer('approved_by');
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_deleted');
            $table->tinyInteger('created_by');
            $table->tinyInteger('updated_by');
            $table->tinyInteger('deleted_by');
            $table->datetime('deleted_at');
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
        Schema::dropIfExists('teacher_on_demand');
    }
}
