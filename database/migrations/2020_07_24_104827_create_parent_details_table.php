<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_details', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('middle_name',50);	
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->string('contact_no',30);
            $table->string('mobile_verified_status', 30);
            $table->date('mobile_verified_on');
            $table->string('alternate_no', 30);	
            $table->string('address', 200);	
            $table->string('district',50);	
            $table->string('city',50);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('pincode',50);
           
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
        Schema::dropIfExists('parent_details');
    }
}
