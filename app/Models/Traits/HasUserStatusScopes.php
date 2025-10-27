<?php

namespace App\Models\Traits;

trait HasUserStatusScopes
{
    public function scopeByUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
