<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dni', 'phone', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public const VALIDATION_RULES = [
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'dni' => ['required', 'integer', 'digits_between:8,9', 'unique:users'],
        'phone' => ['required', 'numeric', 'digits_between:6,9'],
        'email' => ['required', 'email', 'max:255', 'unique:users'],
        'password' => ['string'],
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function scopeSearch(Builder $query, $value)
    {
        if ($value == "") {
            return;
        }

        return  $query->orWhere('name', 'LIKE', "%$value%")
            ->orWhere('dni', 'LIKE', "%$value%");
    }

    public function scopeFilterStatus(Builder $query, $value)
    {
        $query->where('status', $value);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
