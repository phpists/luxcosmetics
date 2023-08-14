<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductQuestionMessage extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'message', 'user_id', 'email', 'username'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
