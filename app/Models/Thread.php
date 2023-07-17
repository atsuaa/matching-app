<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
     * このユーザーの持つスレッド
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_thread');
    }

    public function anotherUser($userId)
    {
        return $this->users()->wherePivot('user_id', '!=', $userId)->first();
    }
}
