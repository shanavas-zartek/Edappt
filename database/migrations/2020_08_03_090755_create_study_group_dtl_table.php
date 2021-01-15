<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyGroupDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_group_dtl', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('study_group_hdr_id');
            $table->tinyInteger('requested_student_id');
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_deleted');
            $table->tinyInteger('created_by');
            $table->tinyInteger('updated_by');
            $table->tinyInteger('deleted_by');
            $table->dateTime('deleted_at', 0);
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
        Schema::dropIfExists('study_group_dtl');
    }
}
