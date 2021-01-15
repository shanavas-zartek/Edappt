<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('parent_id');
            
            $table->string('first_name', 50);
            $table->string('middle_name',50);	
            $table->string('last_name', 50);
            $table->string('gender', 10);
            $table->string('grade',20);
            $table->string('school',100);	
            $table->date('dob');	
            $table->string('student_code',50);
            $table->string('email')->unique();
            $table->string('contact_no',30);
             $table->string('address', 200);
             $table->string('city', 50);
             $table->string('state', 50);
             $table->string('country', 50);
             $table->string('district', 50);
             $table->string('pincode', 25);	
             $table->string('image',100);
             $table->text('syllabus');
            $table->string('best_friend', 50);	
            $table->string('dream', 100);	
            $table->string('pet_name', 50);	
           
            
            
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
        Schema::dropIfExists('student_details');
    }
}
