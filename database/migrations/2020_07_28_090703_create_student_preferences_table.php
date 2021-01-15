<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_preferences', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('preference_category_id');
            $table->tinyInteger('student_id');
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_deleted');
            $table->tinyInteger('created_by');
            $table->tinyInteger('updated_by');
            
            $table->tinyInteger('deleted_by');
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
        Schema::dropIfExists('student_preferences');
    }
}
