<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLdContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ld_contents', function (Blueprint $table) {
            $table->id();
            $table->Integer('category_id');	
            $table->string('file');
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
        Schema::dropIfExists('ld_contents');
    }
}
