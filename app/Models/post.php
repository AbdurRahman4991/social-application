<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class post extends Model
{
    use HasFactory;

    public function comment(): HasMany
    {
        return $this->hasMany(comments::class);
    }

    public function Like(): HasMany
    {
        return $this->hasMany(like::class);
    }
}
