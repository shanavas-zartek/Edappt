<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookslotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookslot', function (Blueprint $table) {
            $table->id();
            $table->Integer('student_id');
            $table->string('topic');
            $table->text('description')->nullable();
            $table->string('file');
            $table->date('requested_date');
            $table->time('requested_time');
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('approval_status');
            $table->datetime('approved_on')->nullable();
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
        Schema::dropIfExists('bookslot');
    }
}
