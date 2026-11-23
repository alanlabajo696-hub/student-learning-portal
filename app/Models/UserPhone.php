<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPhone extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}