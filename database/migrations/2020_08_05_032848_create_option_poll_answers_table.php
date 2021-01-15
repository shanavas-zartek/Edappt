<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionPollAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_poll_answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->Integer('question_id');
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
        Schema::dropIfExists('option_poll_answers');
    }
}
