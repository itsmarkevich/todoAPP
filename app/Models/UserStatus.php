<?php

namespace App\Models;

use App\Models\Traits\HasUserScopes;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasUserScopes;

    protected $fillable = [
        'status_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
