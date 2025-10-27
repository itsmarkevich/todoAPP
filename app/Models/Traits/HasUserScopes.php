<?php

namespace App\Models\Traits;

trait HasUserScopes
{
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhereHas('tasks', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
    }
}
