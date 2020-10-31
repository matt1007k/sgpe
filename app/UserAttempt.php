<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttempt extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'payload'
    ];
}
