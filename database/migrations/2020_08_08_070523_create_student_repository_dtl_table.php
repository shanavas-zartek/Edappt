<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRepositoryDtlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_repository_dtl', function (Blueprint $table) {
            $table->id();
            $table->Integer('repository_hdr_id');
            $table->string('file_title',50);	
            $table->text('description')->nullable();
            $table->string('file_name',100);
            $table->string('file_type',50);	
            $table->string('file_size',50);	
            $table->Integer('sub_category_id');
            
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
        Schema::dropIfExists('student_repository_dtl');
    }
}
