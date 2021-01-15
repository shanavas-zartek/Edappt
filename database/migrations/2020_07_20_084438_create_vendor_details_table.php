<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('vendor_category_id');
            $table->tinyInteger('age_group_id');
            $table->string('first_name', 50);
           
             $table->string('last_name', 50);	
             $table->string('subject', 50);
             $table->string('address', 200);
             $table->string('city', 50);
             $table->string('state', 50);
             $table->string('country', 50);
             $table->string('pincode', 25);	
            $table->string('email')->unique();
            $table->string('phone', 100);	
            $table->string('gender', 10);	
            $table->date('dob');	
            $table->string('qualification',50);
            $table->string('experience',150);
            $table->string('description',150);
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
        Schema::dropIfExists('vendor_details');
    }
}
