<?php

namespace App\Models;

use App\Models\Traits\HasTaskScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasTaskScopes;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'finish_date',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($task) {
            $task->slug = Str::slug($task->title);
        });
        static::updating(function ($task) {
            $task->slug = Str::slug($task->title);
        });
    }
}
