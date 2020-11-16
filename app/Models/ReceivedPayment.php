<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceivedPayment extends Model
{
    protected $fillable = ['payment_id', 'status'];
}
