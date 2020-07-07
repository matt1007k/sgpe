<?php

namespace App\Models;

use App\Events\MessageCreated;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Message extends Model
{
    protected $fillable = ['to', 'subject', 'body'];

    // protected $events = [
    //     'created' => MessageCreated::class
    // ];

    public function scopeSearch(Builder $query, $value)
    {
        if ($value == "") {
            return;
        }

        return  $query->orWhere('to', 'LIKE', "%$value%")
            ->orWhere('subject', 'LIKE', "%$value%");
    }

    public function scopeFilterSend(Builder $query, $value)
    {
        if ($value == 'me') {
            return $query->where('user_id', '!=', Auth::user()->id);
        } else if ($value == 'send') {
            return $query->where('user_id', Auth::user()->id);
        } else {
            return;
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
