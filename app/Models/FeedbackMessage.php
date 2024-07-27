<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FeedbackMessage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'chat_id'];

    protected $table = 'feedback_message';


    public function files(): HasMany
    {
        return $this->hasMany(FeedbackMessageFile::class);
    }

}
