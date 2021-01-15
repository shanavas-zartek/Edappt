<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loginhistory extends Model
{
    protected $table = 'login_history';
    protected $fillable = [
        'logged_user_id',
        'logged_in_time',
        'logged_out_time'
    ];
}
