<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->integer('subscription_plan_id');
            $table->date('subscription_start_date');
            $table->date('subscription_end_date');
            $table->string('invoice_no',30);
            $table->date('invoice_date');
            $table->date('subscription_expiry_date');
            $table->integer('paid_amount');
            $table->string('payment_mode',50);
            $table->string('payment_status',50);
            $table->string('payment_recieptno',50);
            $table->string('transaction_id',50);
            $table->string('response_code',50);
            $table->string('message',100);
            $table->string('card_type',50);
            $table->string('card_expiry',50);            
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_deleted');
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
        Schema::dropIfExists('payments');
    }
}
