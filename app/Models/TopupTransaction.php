<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopupTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'va_code',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
