<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // можно добавить название чата, если требуется

    // Связь с моделью User (многие ко многим, если чат групповой)
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'chat_user', 'chat_id', 'user_id')->withTimestamps();
    }

    // Связь с моделью Message (один ко многим)
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
