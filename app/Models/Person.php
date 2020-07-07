<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    public $allowedSorts = [
        'name', 'paternal_surname'
    ];

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function scopeName(Builder $query, $value)
    {
        $query->where('name', 'LIKE', "%$value%");
    }

    public function scopePaternal_surname(Builder $query, $value)
    {
        $query->where('paternal_surname', 'LIKE', "%$value%");
    }

    public function scopeStatus(Builder $query, $value)
    {
        $query->where('status', 'LIKE', "%$value%");
    }

    public function scopeYear(Builder $query, $value)
    {
        $query->whereYear('created_at', $value);
    }

    public function scopeMonth(Builder $query, $value)
    {
        $query->whereMonth('created_at', $value);
    }

    public function scopeSearch(Builder $query, $values)
    {
        foreach (Str::of($values)->explode(' ') as $value) {
            $query->orWhere('name', 'LIKE', "%$value%")
                ->orWhere('paternal_surname', 'LIKE', "%$value%");
        }
    }
}
