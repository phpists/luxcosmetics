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

    const NEW = 1;

    const VIEWED = 2;
    const CLOSED = 3;


    protected static function booted (): void
    {

        self::deleted(function(self $model) {
            foreach ($model->messages as $message) {
                foreach ($message->files as $file) {
                    try {
                        \Storage::disk($file->disk)->delete($file->path);
                    } catch (\Exception $exception) {
                        \Log::error($exception->getMessage());
                    }
                    $file->delete();
                }

                try {
                    \Storage::disk('google')->delete(FeedbackMessageFile::FILES_PATH . $message->id);
                } catch (\Exception $exception) {
                    \Log::error($exception->getMessage());
                }

                $message->delete();
            }
        });

    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FeedbackMessage::class, 'chat_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(FeedbackMessage::class, 'chat_id')->latestOfMany();
    }

}
