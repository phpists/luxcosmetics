<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedbacks_reason_id',
        'status',
        'user_id',
        'email',
        'phone',
        'order_number',
        'feedback_theme',
        'assignee_id'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FeedbackMessage::class, 'chat_id');
    }
}
