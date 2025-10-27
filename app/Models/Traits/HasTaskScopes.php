<?php

namespace App\Models\Traits;

trait HasTaskScopes
{
    public function scopeFindTask($query, $search)
    {
        return $query->where('title', 'like', "%{$search}%");
    }

    public function scopeTaskBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function scopeByUserAndSlug($query, $userId, $slug)
    {
        return $query
        ->where('slug', $slug)
        ->where('user_id', $userId);
    }
}
