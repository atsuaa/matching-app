<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thread extends Model
{
    use HasFactory;

    /**
     * スレッドのメッセージ
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * 相手のユーザー
     */
    public function anotherUser(User $user)
    {
        return $this->belongsToMany(User::class, 'thread_members')->wherePivot('user_id', '!=', $user->id)->first();
    }
}
