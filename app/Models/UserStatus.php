<?php

namespace App\Models;

use App\Models\Traits\HasUserScopes;
use App\Models\Traits\HasUserStatusScopes;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasUserStatusScopes;

    protected $fillable = [
        'status_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
