<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionPollQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_poll_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->Integer('poll_type_id');
            $table->string('approval_status');
            $table->datetime('approved_on');
            $table->Integer('approved_by');
            $table->Integer('is_admin');
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
        Schema::dropIfExists('option_poll_questions');
    }
}
