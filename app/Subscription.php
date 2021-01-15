<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscription_plans';

    protected $fillable = [
        'package_name',
        'description',
        'amount',
        'duration',
        'start_date',
        'end_date',
        'is_active',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
