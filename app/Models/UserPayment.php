<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    protected $fillable = ['count_latest_payments', 'user_id'];

    public function user(){
        return $this->hasOne(User::class);
    }
}
