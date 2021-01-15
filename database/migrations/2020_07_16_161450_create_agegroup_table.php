<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgegroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agegroup', function (Blueprint $table) {
            $table->id();
            $table->string('age_group', 100);	
            $table->text('description');	
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
        Schema::dropIfExists('agegroup');
    }
}
