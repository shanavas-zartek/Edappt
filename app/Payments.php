<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'parent_id',
        'subscription_plan_id',
        'subscription_start_date',
        'subscription_end_date',
        'invoice_no',
        'invoice_date',
        'subscription_expiry_date',
        'paid_amount',
        'payment_mode',
        'payment_status',
        'payment_recieptno',
        'transaction_id',
        'response_code',
        'message',
        'card_type',
        'card_expiry',
        'is_active',
        'is_deleted',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
