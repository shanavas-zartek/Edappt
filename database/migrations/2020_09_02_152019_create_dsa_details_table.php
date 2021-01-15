<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsa_details', function (Blueprint $table) {
            $table->id();
            
           
            $table->string('first_name', 50);
           
             $table->string('last_name', 50);	
            
             $table->string('address', 200);
             $table->string('city', 50);
             $table->string('state', 50);
             $table->string('district', 50);
             $table->string('country', 50);
             $table->string('pincode', 25);	
            $table->string('email')->unique();
            $table->string('contact_no', 100);	
            $table->string('alternate_no', 100);
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_deleted');
            $table->tinyInteger('created_by');
            $table->tinyInteger('updated_by');
            $table->datetime('deleted_at');
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
        Schema::dropIfExists('dsa_details');
    }
}
